<?php

namespace App\Services;

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class DayService
{
    public function getReserved($dayData)
    {
        if ($dayData) {
            return (int) $dayData->reserved_a
            + (int) $dayData->reserved_b
            + (int) $dayData->reserved_c;
        }

        return null;
    }

    public function getDayData($date)
    {
        return Day::where('date', $date)->first();
    }

    public function setTc($array)
    {
        Day::updateOrCreate([
            'date' => $array['date'],
        ], [
            'tc' => (int) $array['tc'],
        ]);
    }

    public function updateManualInput($dayData): void
    {
        Day::updateOrCreate([
            'date' => $dayData['date'],
        ], [
            'time_a' => $dayData['time_a'],
            'reserved_a' => $dayData['reserved_a'],
            'confirm_a' => $dayData['confirm_a'],
            'time_b' => $dayData['time_b'],
            'reserved_b' => $dayData['reserved_b'],
            'confirm_b' => $dayData['confirm_b'],
            'time_c' => $dayData['time_c'],
            'reserved_c' => $dayData['reserved_c'],
            'confirm_c' => $dayData['confirm_c'],
            'note' => $dayData['note'],
        ]);
    }

    public function updateManualInputStartOfDate($dayData): void
    {
        Day::updateOrCreate([
            'date' => Carbon::parse($dayData['date'])->format('Y-m-d'),
        ], [
            'note' => $dayData['note'],
            'discrepancy' => $dayData['discrepancy'],
        ]);
    }

    public function getLastRefreshed($date = null)
    {
        $lastRefreshed = Day::where('date', $date)->first();
        if ($lastRefreshed && $lastRefreshed->last_update) {
            return $lastRefreshed['last_update']->toDayDateTimeString();
        }

        return null;
    }

    public function saveLastUpdate($date)
    {
        Day::updateOrCreate(
                ['date' => $date],
                ['last_update' => now()]
            );
    }

    public function saveDataFromImportFile($collection)
    {
        $collection = $collection->map(function ($item) {
            $date = is_a($item['time_a'], 'DateTime') ? $item['time_a']->format('Y-m-d') : Carbon::parse($item['date'])->format('Y-m-d');

            $time_a = Arr::has($item, 'time_a') ? is_a($item['time_a'], 'DateTime') ? $item['time_a']->format('H:i:s') : (trim($item['time_a']) ? Carbon::parse($item['time_a'])
            ->format('H:i:s') : null) : null;

            $time_b = Arr::has($item, 'time_b') ? is_a($item['time_b'], 'DateTime') ? $item['time_b']->format('H:i:s') : (trim($item['time_a']) ? Carbon::parse($item['time_b'])
            ->format('H:i:s') : null) : null;

            $time_c = Arr::has($item, 'time_c') ? is_a($item['time_c'], 'DateTime') ? $item['time_c']->format('H:i:s') : (trim($item['time_a']) ? Carbon::parse($item['time_c'])
            ->format('H:i:s') : null) : null;

            return [
                'date' => $date,

                'reserved_a' => Arr::has($item, 'reserved_a') ? $item['reserved_a'] : null,
                'time_a' => $time_a,
                'confirm_a' => Arr::has($item, 'confirm_a') ? $item['confirm_a'] : null,

                'reserved_b' => Arr::has($item, 'reserved_b') ? $item['reserved_b'] : null,
                'time_b' => $time_b,
                'confirm_b' => Arr::has($item, 'confirm_b') ? $item['confirm_b'] : null,

                'reserved_c' => Arr::has($item, 'reserved_c') ? $item['reserved_c'] : null,
                'time_c' => $time_c,
                'confirm_c' => Arr::has($item, 'confirm_c') ? $item['confirm_c'] : null,
            ];
        });

        foreach ($collection as $item) {
            $item = array_filter($item, 'strlen');

            $day = Day::firstOrCreate([
                'date' => $item['date'],
            ]);

            $day->fill($item);

            $day->save();
        }
    }
}
