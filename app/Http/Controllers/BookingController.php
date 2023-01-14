<?php

namespace App\Http\Controllers;

use App\Models\Concierge;
use App\Services\BookingService;
use App\Services\DayService;
use App\Services\DownloadService;
use App\Services\OrderService;
use App\Services\VentrataService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Rap2hpoutre\FastExcel\FastExcel;

class BookingController extends Controller
{
    public function __construct(
        protected Request $request,
        public DayService $dayService,
        public BookingService $bookingService,
        public OrderService $orderService
    ) {
    }

    public function oneDayView(Request $request)
    {
        $date = formatDate($request->date);
        $orders = $this->orderService->getOrders($date);
        $bookings = $this->bookingService->getBookingsTotalDay($orders, $date);
        $total = $this->bookingService->getTotal($bookings);
        $dayData = $this->dayService->getDayData($date);

        return Inertia::render('OneDayView/Index', [
            'bookings' => $bookings,
            'lastRefreshed' => $dayData && $dayData->last_update ? $dayData->last_update->toDayDateTimeString() : null,
            'orders' => $orders->toArray(),
            'dayData' => $dayData ? $dayData->only(['note', 'discrepancy', 'tc']) : null,
            'runningCount' => $this->bookingService->getRunningCount($bookings, $orders),
            'stats' => $this->orderService->getStatistic($orders, $total, $date, $dayData),
            'times' => fn () => $this->bookingService->getTimes($bookings),
            'options' => fn () => config('constants.order_options'),
            'filters' => [
                'date' => $date,
            ],
            'tourConcierges' => Concierge::select('id', 'initials')->get()->toArray(),
            'discrepancyTypes' => config('constants.discrepancy_types'),
        ]);
    }

    public function update(Request $request, VentrataService $ventrataService)
    {
        $ventrataService->updateManualInput($request->all());

        return back()->with('success', 'Updated');
    }

    public function fetchingData(Request $request, VentrataService $ventrataService)
    {
        try {
            $ventrataService->pullBookings($request->get('date'));

            return back()->with('success', 'Fetching is finished');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('error', 'Fetching is not finished');
        }
    }

    public function indexDateRangeView(Request $request)
    {
        $dateRange = formatDate($request->date, true);

        return Inertia::render('DateRangeView/Index', [
            'lastRefreshed' => $this->dayService->getLastRefreshed($dateRange[1]),
            'bookings' => $this->bookingService->getDateRangeData($dateRange),
            'times' => config('constants.times'),
            'date' => $dateRange,
        ]);
    }

    public function dayDataUpdate(Request $request)
    {
        try {
            $this->dayService->updateManualInput($request->all());

            return back()->with('success', 'Updated');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('warning', 'Not updated');
        }
    }

    public function dayDataUpdateStartOfDate(Request $request)
    {
        try {
            $this->dayService->updateManualInputStartOfDate($request->all());

            return back()->with('success', 'Updated');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('warning', 'Not updated');
        }
    }

    public function download(Request $request, DownloadService $downloadService)
    {
        $dateRange = formatDate($request->date);
        $bookings = $this->bookingService->getDateRangeData($dateRange);

        return $downloadService->download($request, $bookings, 'bookings');
    }

    public function importFile(Request $request)
    {
        if (! in_array($request->file->getClientOriginalExtension(), ['xlsx', 'csv'])) {
            return back()->with('warning', 'Format of the file should be CSV or XLSX');
        }

        // Fix bag for CSV
        // https://github.com/rap2hpoutre/fast-excel/issues/185#issuecomment-918006719
        $filePath = $request->file('file')->path();
        $newFilePath = $filePath.'.'.$request->file('file')->getClientOriginalExtension();
        move_uploaded_file($filePath, $newFilePath);
        // Fix bag for CSV

        $collection = (new FastExcel())->import($newFilePath);

        try {
            $this->dayService->saveDataFromImportFile($collection);

            return back()->with('success', 'Imported');
        } catch (\Throwable $th) {
            \Log::error($th);

            return back()->with('warning', 'Not imported');
        }
    }
}
