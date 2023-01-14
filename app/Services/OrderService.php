<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Concierge;
use App\Models\Day;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class OrderService
{
    public function __construct(
        public DayService $dayService,
    ) {
    }

    public function getOrders($date)
    {
        return Order::ofDate($date)
            ->orderBy('time')
            ->get();
    }

    public function getStatistic($orders, $total, $date = null, $dayData = null): array
    {
        $orderAdult = $orders->where('option', 'order')->sum('adult');
        $orderChild = $orders->where('option', 'order')->sum('child');

        $noShowsAdult = $orders->where('option', 'no_shows')->sum('adult');
        $noShowsChild = $orders->where('option', 'no_shows')->sum('child');

        $addOnAdult = $orders->where('option', 'add_on')->sum('adult');
        $addOnChild = $orders->where('option', 'add_on')->sum('child');

        $adjustmentAdult = $orders->where('option', 'adjustment')->sum('adult');
        $adjustmentChild = $orders->where('option', 'adjustment')->sum('child');

        $ticketsNeededAdult = $total['adult'] + $addOnAdult - $noShowsAdult;
        $ticketsNeededChild = $total['child'] + $addOnChild - $noShowsChild;
        $needed = $ticketsNeededAdult + $ticketsNeededChild;

        $endAdult = $orders->where('option', 'end') ? $orders->where('option', 'end')->sum('adult') : 0;
        $endChild = $orders->where('option', 'end') ? $orders->where('option', 'end')->sum('child') : 0;

        $preorderAdult = $orders->where('option', 'start') ? $orders->where('option', 'start')->sum('adult') : 0;
        $preorderChild = $orders->where('option', 'start') ? $orders->where('option', 'start')->sum('child') : 0;

        $purchased = $preorderAdult + $preorderChild + $orderAdult + $orderChild + $adjustmentAdult + $adjustmentChild;
        $finalManifest = $total['adult'] + $total['child'] + $addOnAdult + $addOnChild;

        $spoilage = $purchased - $needed > 0 ? $purchased - $needed : 0;
        $spoilageProcent = round($spoilage > 0 ? ($spoilage / $purchased) * 100 : 0);

        $savings = $finalManifest - $purchased > 0 ? $finalManifest - $purchased : 0;
        $savingsProcent = round($savings > 0 ? ($savings / $finalManifest) * 100 : 0);

        $discrepancyAdult = abs(($preorderAdult + $noShowsAdult + $orderAdult - $total['adult'] - $addOnAdult - $adjustmentAdult) - $endAdult);
        $discrepancyChild = abs(($preorderChild + $noShowsChild + $orderChild - $total['child'] - $addOnChild - $adjustmentChild) - $endChild);

        $reserved = null;
        if ($date) {
            $reserved = $this->dayService->getReserved($dayData);
        }

        return [
            'order_adult' => $orderAdult,
            'order_child' => $orderChild,
            'no_shows_adult' => $noShowsAdult,
            'no_shows_child' => $noShowsChild,
            'add_on_adult' => $addOnAdult,
            'add_on_child' => $addOnChild,
            'adjustment_adult' => $adjustmentAdult ? $adjustmentAdult : 0,
            'adjustment_child' => $adjustmentChild ? $adjustmentChild : 0,
            'manifest_adult' => $total['adult'],
            'manifest_child' => $total['child'],
            'final_manifest' => $finalManifest,
            'tickets_needed_adult' => $ticketsNeededAdult,
            'tickets_needed_child' => $ticketsNeededChild,
            'purchased_adult' => $preorderAdult + $orderAdult,
            'purchased_child' => $preorderChild + $orderChild,
            'purchased' => $purchased,
            'needed' => $needed,
            'spoilage' => round($spoilage),
            'spoilage_procent' => $spoilageProcent > 0 ? $spoilageProcent : 0,
            'savings' => $savings > 0 ? round($savings) : 0,
            'savings_procent' => $savingsProcent > 0 ? $savingsProcent : 0,
            'cost' => $orders->where('option', '!=', 'no_shows')->sum('cost'),
            'reserved' => $reserved,
            'discrepancy_adult' => $discrepancyAdult,
            'discrepancy_child' => $discrepancyChild,
            'discrepancy' => $discrepancyAdult + $discrepancyChild !== 0 ? true : false,
        ];
    }

    public function getDataForMetrics($dateRange, $discrepancyType = null, $tc = null)
    {
        $metricsTable = collect();
        $metricsChart = [
            'datasets' => [],
            'labels' => [],
        ];
        $spoilage = [
            'name' => 'Spoilage',
            'values' => [],
        ];
        $savings = [
            'name' => 'Savings',
            'values' => [],
        ];
        $discrepancy = [
            'name' => 'Discrepancy',
            'values' => [],
        ];

        $daysData = Day::select(['tc', 'date', 'discrepancy'])->whereBetween('date', $dateRange)->get();

        if ($discrepancyType) {
            $daysData = $daysData->where('discrepancy', $discrepancyType);
        }

        if ($tc) {
            $daysData = $daysData->where('tc', $tc);
        }

        $concierges = Concierge::select(['id', 'initials'])->get();
        $bookingsData = Booking::whereBetween('tour_date', $dateRange)->get();
        $orders = Order::whereBetween('date', $dateRange)->get();

        foreach ($daysData as $day) {
            $total = $this->calcTotal($bookingsData->where('tour_date', Carbon::parse($day->date)));
            $ordersOfDate = $orders->where('date', $day->date);

            $dayData = $daysData->where('date', $day->date)->first();
            $tcOfDay = $dayData && Arr::has($dayData, 'tc') ? $concierges->firstWhere('id', $dayData['tc']) : null;

            if ($total) {
                $stat = $this->getStatistic($ordersOfDate, $total);
                array_push($spoilage['values'], $stat['spoilage_procent']);
                array_push($savings['values'], $stat['savings_procent']);
                array_push($discrepancy['values'], $stat['discrepancy_adult'] + $stat['discrepancy_child']);

                $discrepancyProcent = $stat['purchased'] ? (($stat['discrepancy_adult'] + $stat['discrepancy_child']) / $stat['purchased']) * 100 : 0;

                $metricsTable->push([
                    'id' => $day->date,
                    'date' => Carbon::parse($day->date)->toFormattedDateString(),
                    'needed' => $stat['needed'],
                    'purchased' => $stat['purchased'],
                    'spoilage' => $stat['spoilage'],
                    'spoilage_procent' => $stat['spoilage_procent'],
                    'manifest' => $stat['final_manifest'],
                    'savings' => $stat['savings'],
                    'savings_procent' => $stat['savings_procent'],
                    'discrepancy_number' => $stat['discrepancy_adult'] + $stat['discrepancy_child'],
                    'discrepancy_procent' => round($discrepancyProcent, 2),
                    'discrepancy' => $stat['discrepancy_adult'] + $stat['discrepancy_child'] !== 0 ? true : false,
                    'tc' => $tcOfDay ? $tcOfDay->toArray() : null,
                ]);
            }

            array_push($metricsChart['labels'], Carbon::parse($day->date)->format('d.m'));
        }
        array_push($metricsChart['datasets'], $spoilage, $savings, $discrepancy);

        $niceDateFirst = Carbon::parse($dateRange[0])->format('M j');
        $niceDateSecond = Carbon::parse($dateRange[1])->format('M j');

        $tcsCollection = collect();
        if ($metricsTable->whereNotNull('tc')->first()) {
            $dayWithTC = $metricsTable->whereNotNull('tc')->groupBy('tc.id');
            foreach ($dayWithTC as $key => $day) {
                $tcsCollection->push([
                    'id' => $day[0]['id'],
                    'date' => $day[0]['date'],
                    'needed' => $day->sum('needed'),
                    'purchased' => $day->sum('purchased'),
                    'spoilage' => $day->sum('spoilage'),
                    'spoilage_procent' => $day->sum('spoilage_procent'),
                    'manifest' => $day->sum('manifest'),
                    'savings' => $day->sum('savings'),
                    'savings_procent' => $day->sum('savings_procent'),
                    'discrepancy_number' => $day->sum('discrepancy_number'),
                    'discrepancy_procent' => $day->sum('purchased') ? round((($day->sum('discrepancy_number') / $day->sum('purchased')) * 100), 2) : 0,
                    'discrepancy' => true,
                    'tc' => $day[0]['tc'],
                ]);
            }
        }
        $metricsTotal = collect([
            'date' => $niceDateFirst.' - '.$niceDateSecond,
            'needed' => $metricsTable->sum('needed'),
            'purchased' => $metricsTable->sum('purchased'),
            'spoilage' => $metricsTable->sum('spoilage'),
            'spoilage_procent' => $metricsTable->sum('purchased') > 0 ? round(($metricsTable->sum('spoilage') / $metricsTable->sum('purchased')) * 100, 2) : 0,
            'manifest' => $metricsTable->sum('manifest'),
            'savings' => $metricsTable->sum('savings'),
            'savings_procent' => (int) $metricsTable->sum('manifest') > 0 ? round((
                (int) $metricsTable->sum('savings') / (int) $metricsTable->sum('manifest') * 100), 2) : 0,
            'discrepancy_number' => $metricsTable->sum('discrepancy_number'),
            'discrepancy_procent' => $metricsTable->sum('purchased') > 0 ? round(($metricsTable->sum('discrepancy_number') / $metricsTable->sum('purchased') * 100), 2) : 0,
        ]);

        return ['metricsChart' => $metricsChart, 'metricsTable' => $metricsTable->paginate(30), 'total' => $metricsTotal, 'totalTc' => $tcsCollection];
    }

    public function calcTotal($bookingsData): array
    {
        if ($bookingsData) {
            return [
                'adult' => $bookingsData->sum('adult'),
                'child' => $bookingsData->sum('child'),
            ];
        }

        return [];
    }
}
