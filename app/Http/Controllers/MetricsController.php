<?php

namespace App\Http\Controllers;

use App\Models\Concierge;
use App\Services\DayService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MetricsController extends Controller
{
    public function index(Request $request, DayService $dayService, OrderService $orderService)
    {
        $dateRange = formatDate($request->date, true);
        $discrepancyType = $request->type ? $request->type : null;
        $tc = $request->tc ? $request->tc : null;

        return Inertia::render('Metrics/Index', [
            'lastRefreshed' => $dayService->getLastRefreshed($dateRange[1]),
            'metrics' => $orderService->getDataForMetrics($dateRange, $discrepancyType, $tc),
            'discrepancyTypes' => config('constants.discrepancy_types'),
            'tourConcierges' => Concierge::select('id', 'initials')->get()->toArray(),
            'filters' => [
                'date' => $dateRange,
                'type' => $discrepancyType,
                'tc' => $tc,
            ],
        ]);
    }
}
