<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\Booking;
use App\Settings\StatueSettings;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class VentrataService
{
    private PendingRequest $client;

    public $date;

    public function pullBookings($date = null, $type = 'public')
    {
        $this->client = Http::baseUrl('https://api.ventrata.com')->withToken(
            config('vetrata.api_key')
        );

        if ($date === null) {
            $date = today()->format('Y-m-d');
        }

        if (is_array($date)) {
            $this->setRangeDate($date);
        } else {
            $this->date = Carbon::parse($date)->format('Y-m-d');
            $this->retrieveBookings();
        }
    }

    private function setRangeDate($dateRange = null)
    {
        if ($dateRange === null) {
            $period = CarbonPeriod::start(now()->subDays(4))->untilNow(true);
        } else {
            $period = CarbonPeriod::start($dateRange[0])->until($dateRange[1]);
        }

        foreach ($period as $date) {
            $this->date = $date->format('Y-m-d');
            $this->retrieveBookings();
        }
    }

    private function retrieveBookings()
    {
        $response = null;

        try {
            $response = $this->client->get('/octo/bookings', [
                'localDate' => $this->date,
            ]);

            $response->throw(function ($response, $e) {
                \Log::error($e);
                throw new ServiceException($e);
            })->json();
        } catch (\Throwable $th) {
            \Log::error($th);
        }

        if ($response) {
            $bookings = collect($response->json())
            ->whereIn('productId', $this->getProductsId())
            ->whereIn('optionId', $this->getOptionsId());

            if ($bookings->count() > 0) {
                $this->collectBookings($bookings);
            }
        }

        $this->storeLastUpdate();
    }

    private function collectBookings($bookings)
    {
        foreach ($bookings as $booking) {
            $email = $booking['contact']['emailAddress'];

            if (Str::contains($email, 'tripadvisor') || Str::contains($email, 'getyourguide')) {
                $email = null;
            }

            $this->storeBooking([
                'uuid' => $booking['uuid'],
                'product_id' => $booking['productId'],
                'option_id' => $booking['optionId'] !== 'DEFAULT' ? $booking['optionId'] : null,
                'product_code' => $booking['product']['reference'],
                'product_name' => $booking['optionId'] !== 'DEFAULT' ? $booking['option']['title'] : $booking['product']['title'],
                'status' => $booking['status'],
                'tour_time' => Carbon::parse($booking['availabilityId'])->format('H:i'),
                'first_name' => $booking['contact']['firstName'],
                'last_name' => $booking['contact']['lastName'],
                'note' => $booking['notes'],
                'email' => $email,
                'adult' => collect($booking['unitItems'])->filter(function ($unit) {
                    return in_array($unit['unit']['type'], [
                        'ADULT',
                    ]);
                })->count(),
                'child' => collect($booking['unitItems'])->filter(function ($unit) {
                    return in_array($unit['unit']['type'], [
                        'CHILD',
                    ]);
                })->count(),
            ]);
        }

        $this->extraCheking($bookings);
    }

    public function extraCheking($bookings)
    {
        $dbData = Booking::where('tour_date', $this->date)->pluck('uuid');
        $diff = $dbData->diff($bookings->whereNotIn('status', ['CANCELLED', 'PENDING', 'EXPIRED'])->pluck('uuid'));

        $forDeleting = Booking::where('tour_date', $this->date)->whereIn('uuid', $diff->values())->get();

        foreach ($forDeleting as $item) {
            $item->delete();
        }
    }

    public function storeBooking($booking): void
    {
        if (in_array($booking['status'], ['CANCELLED', 'PENDING', 'EXPIRED'])) {
            Booking::where('uuid', $booking['uuid'])->delete();
        } else {
            $bookingOld = Booking::where('uuid', $booking['uuid'])->first();

            // special tour that move to bottom of list
            if ($booking['product_id'] === '1d563248-94d4-4430-8a0a-5bb332be50a7' && $booking['option_id'] === 'b0eea853-84a6-4de5-ac3b-b3f3d003c36e') {
                $booking['tour_time'] = '11:00:00';
            }

            DB::transaction(function () use ($booking, $bookingOld) {
                if ($bookingOld) {
                    $diff = array_diff($booking, $bookingOld->toArray());

                    if (! empty($diff)) {
                        $bookingOld->update([
                            'product_id' => $booking['product_id'],
                            'option_id' => $booking['option_id'],
                            'product_code' => $booking['product_code'],
                            'product_name' => $booking['product_name'],
                            'tour_date' => $this->date,
                            'tour_time' => $booking['tour_time'],
                            'adult' => $booking['adult'],
                            'child' => $booking['child'],
                            'status' => $booking['status'],
                            'first_name' => $booking['first_name'],
                            'last_name' => $booking['last_name'],
                            'email' => $booking['email'],
                            'note' => $booking['note'],
                        ]);
                    }
                } else {
                    Booking::create([
                        'uuid' => $booking['uuid'],
                        'product_id' => $booking['product_id'],
                        'option_id' => $booking['option_id'],
                        'product_code' => $booking['product_code'],
                        'product_name' => $booking['product_name'],
                        'tour_date' => $this->date,
                        'tour_time' => $booking['tour_time'],
                        'adult' => $booking['adult'],
                        'child' => $booking['child'],
                        'status' => $booking['status'],
                        'first_name' => $booking['first_name'],
                        'last_name' => $booking['last_name'],
                        'email' => $booking['email'],
                        'note' => $booking['note'],
                    ]);
                }
            });
        }
    }

    public function storeLastUpdate(): void
    {
        if (is_array($this->date)) {
            $period = CarbonPeriod::start($this->date[0])->until($this->date[1]);

            foreach ($period as $date) {
                app(DayService::class)->saveLastUpdate($date->format('Y-m-d'));
            }
        } else {
            app(DayService::class)->saveLastUpdate($this->date);
        }
    }

    public function updateManualInput($booking): void
    {
        Booking::query()->updateOrCreate([
            'id' => $booking['id'],
        ], [
            'check_in' => $booking['check_in'],
            'guide' => $booking['guide'],
            'note' => $booking['note'],
        ]);
    }

    public function getProductsId(): array
    {
        return Arr::flatten(app(StatueSettings::class)->products);
    }

    public function getOptionsId(): array
    {
        return Arr::flatten(app(StatueSettings::class)->product_options);
    }
}
