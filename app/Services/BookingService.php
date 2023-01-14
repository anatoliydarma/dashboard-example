<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Day;
use App\Models\Order;
use Carbon\Carbon;

class BookingService
{
    public function getManifest($date)
    {
        return Booking::ofDate($date)
        ->select('id', 'product_code', 'product_name', 'tour_time', 'check_in', 'first_name', 'last_name', 'email', 'adult', 'child', 'guide', 'note')
        ->get()
        ->groupBy(['product_code', 'tour_time'])
        ->collapse()
        ->sortKeys();
    }

    public function getDateRangeData($dateRange)
    {
        $bookingsData = Booking::whereBetween('tour_date', [$dateRange])
            ->get()
            ->groupBy('tour_date');

        $ordersData = Order::whereBetween('date', [$dateRange])
            ->get();

        $dayData = Day::whereBetween('date', [$dateRange])
            ->get();

        $itemMap = collect();

        foreach ($bookingsData as $key => $value) {
            $value = $value->pipe(function ($value) use ($key, $ordersData, $dayData) {
                $date = Carbon::parse($key)->format('Y-m-d');

                $reservedA = $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->reserved_a : 0;
                $reservedB = $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->reserved_b : 0;
                $reservedC = $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->reserved_c : 0;

                return collect([
                    'id' => Carbon::parse($key)->format('Y-m-d'),
                    'date' => Carbon::parse($key)->rawFormat('D, d M'),
                    'tickets_adult' => $value->sum('adult'),
                    'tickets_child' => $value->sum('child'),
                    'purchased_adult' => $ordersData->where('date', $date)->whereIn('option', ['order', 'start'])->sum('adult'),
                    'purchased_child' => $ordersData->where('date', $date)->whereIn('option', ['order', 'start'])->sum('child'),

                    'reserved_a' => $reservedA,
                    'time_a' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->time_a : null,
                    'confirm_a' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->confirm_a : null,

                    'reserved_b' => $reservedB,
                    'time_b' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->time_b : null,
                    'confirm_b' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->confirm_b : null,

                    'reserved_c' => $reservedC,
                    'time_c' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->time_c : null,
                    'confirm_c' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->confirm_c : null,

                    'note' => $dayData->firstWhere('date', $date) ? $dayData->firstWhere('date', $date)->note : null,

                    'reserved_total' => $reservedA + $reservedB + $reservedC,
                ]);
            });
            $itemMap->push($value);
        }

        return $itemMap->sortBy('id')->values()->toArray();
    }

    public function getGrowthData($dateRange)
    {
        $bookingsData = Booking::whereBetween('tour_date', [$dateRange])
            ->get()
            ->groupBy('tour_date');

        $ordersData = Order::whereBetween('date', [$dateRange])
            ->get();

        $dayData = Day::whereBetween('date', [$dateRange])
            ->get();

        $itemMap = collect();

        foreach ($bookingsData as $key => $value) {
            $value = $value->pipe(function ($value) use ($key) {
                $totalDay = $value->sum('adult') + $value->sum('child');
                $date = Carbon::parse($key)->format('Y-m-d');

                return collect([
                    'id' => Carbon::parse($key)->format('Y-m-d'),
                    'date' => Carbon::parse($key)->rawFormat('D, d M'),
                    'tickets_adult' => $value->sum('adult'),
                    'tickets_child' => $value->sum('child'),
                    'tickets_total' => $totalDay,
                ]);
            });

            $itemMap->push($value);
        }

        return $itemMap->sortBy('id')->values()->toArray();
    }

    public function getTimes($bookings): array
    {
        return $bookings->pluck('tour_time')->unique()->values()->toArray();
    }

    public function getTotal($bookings): array
    {
        $totalData = [];

        array_push($totalData, [
            'adult' => $bookings->sum('adult'),
            'child' => $bookings->sum('child'),
        ]);

        return $totalData[0];
    }

    public function getBookingsTotalDay($orders, $date)
    {
        $bookings = Booking::ofDate($date)
        ->orderBy('tour_time')
        ->get()
        ->groupBy(['product_code', 'tour_time']);

        $bookingsMap = collect();

        foreach ($bookings as $item) {
            $itemMap = collect();

            if ($item !== null) {
                foreach ($item as $value) {
                    if ($value !== null) {
                        $adultNoShows = $orders->where('time', $value[0]['tour_time'])->where('option', 'no_shows')->sum('adult'); // @phpstan-ignore-line
                        $childNoShows = $orders->where('time', $value[0]['tour_time'])->where('option', 'no_shows')->sum('child'); // @phpstan-ignore-line

                        $booking = $value->pipe(function ($value) use ($orders, $childNoShows, $adultNoShows) { // @phpstan-ignore-line
                            return collect([
                                'adult' => $value->sum('adult'),
                                'child' => $value->sum('child'),
                                'product_id' => $value[0]['product_id'],
                                'option_id' => $value[0]['option_id'],
                                'product_code' => $value[0]['product_code'],
                                'product_name' => $value[0]['product_name'],
                                'tour_time' => $value[0]['tour_time'],
                                'adult_no_shows' => $adultNoShows,
                                'child_no_shows' => $childNoShows,
                                'adult_add_on' => $orders->where('time', $value[0]['tour_time'])->where('option', 'add_on')->sum('adult'),
                                'child_add_on' => $orders->where('time', $value[0]['tour_time'])->where('option', 'add_on')->sum('child'),
                            ]);
                        });
                        $itemMap->push($booking);
                    }
                }
                $bookingsMap->push($itemMap);
            }
        }

        return $bookingsMap->collapse()->sortBy('tour_time')->values();
    }

    public function getRunningCount($bookings, $orders)
    {
        $runningCount = collect();

        $preorderAdult = $orders->where('option', 'start') ? $orders->where('option', 'start')->sum('adult') : 0;
        $preorderChild = $orders->where('option', 'start') ? $orders->where('option', 'start')->sum('child') : 0;

        $prevTime = null;

        foreach ($bookings as $item) {
            if ($prevTime === $item['tour_time']) {
                $adult = $preorderAdult - $item['adult'];
                $child = $preorderChild - $item['child'];
            } else {
                $adult = $preorderAdult - $item['adult']
                + $orders->where('time', $item['tour_time'])->whereIn('option', ['no_shows', 'order'])->sum('adult')
                - $orders->where('time', $item['tour_time'])->whereIn('option', ['add_on', 'adjustment'])->sum('adult');

                $child = $preorderChild - $item['child']
                + $orders->where('time', $item['tour_time'])->whereIn('option', ['no_shows', 'order'])->sum('child')
                - $orders->where('time', $item['tour_time'])->whereIn('option', ['add_on', 'adjustment'])->sum('child');
            }

            $runningCount->push([
                'product_code' => $item['product_code'],
                'tour_time' => $item['tour_time'],
                'adult' => $adult,
                'child' => $child,
            ]);

            $prevTime = $item['tour_time'];
            $preorderAdult = $adult;
            $preorderChild = $child;
        }

        $total = [
            'start_adult' => $orders->where('option', 'start') ? $orders->where('option', 'start')->sum('adult') : 0,
            'start_child' => $orders->where('option', 'start') ? $orders->where('option', 'start')->sum('child') : 0,

            'end_adult' => $orders->where('option', 'end')->first() ? $orders->where('option', 'end')->first()->adult : 0,
            'end_child' => $orders->where('option', 'end')->first() ? $orders->where('option', 'end')->first()->child : 0,
        ];

        return ['data' => $runningCount, 'total' => $total];
    }
}
