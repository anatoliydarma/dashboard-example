<?php

if (! function_exists('formatDate')) {
    function formatDate($date = null, $range = false)
    {
        if ($range) {
            if ($date) {
                session(['daterange' => $date]);

                return $date;
            } else {
                return checkDateInSession($range);
            }
        } else {
            if ($date) {
                session(['date' => $date]);

                return $date;
            } else {
                return checkDateInSession();
            }
        }
    }
}

if (! function_exists('checkDateInSession')) {
    function checkDateInSession($isArray = false)
    {
        if ($isArray) {
            if (session()->has('daterange')) {
                return session('daterange');
            } else {
                return [
                    today()->subDays(4)->toDateString(),
                    today()->toDateString(),
                ];
            }
        } else {
            if (session()->has('date')) {
                return session('date');
            } else {
                return today()->toDateString();
            }
        }
    }
}
