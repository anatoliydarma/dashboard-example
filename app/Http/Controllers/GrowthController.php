<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\DayService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GrowthController extends Controller
{
    public function index(
        Request $request,
        DayService $dayService,
        BookingService $bookingService
    ) {
        $dateRange = formatDate($request->date, true);

        return Inertia::render('Growth/Index', [
            'growth' => $bookingService->getGrowthData($dateRange),
            'lastRefreshed' => $dayService->getLastRefreshed($dateRange[1]),
            'date' => $dateRange,
        ]);
    }
}
