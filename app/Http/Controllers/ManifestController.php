<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\DayService;
use App\Services\DownloadService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManifestController extends Controller
{
    public function __construct(
        protected Request $request,
        public BookingService $bookingService
    ) {
    }

    public function index(Request $request, DayService $dayService)
    {
        $date = formatDate($request->date);

        return Inertia::render('Manifest/Index', [
            'manifest' => $this->bookingService->getManifest($date)->toArray(),
            'lastRefreshed' => $dayService->getLastRefreshed($date),
            'filters' => [
                'date' => $date,
            ],
        ]);
    }

    public function download(Request $request, DownloadService $downloadService)
    {
        $date = formatDate($request->date);

        return $downloadService->download($request, $this->bookingService->getManifest($date), 'manifest');
    }
}
