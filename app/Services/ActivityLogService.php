<?php

namespace App\Services;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

final class ActivityLogService
{
    public function getActivityLogs(Request $request)
    {
        $search = $request->search ? $request->search : null;
        $date = $request->date ? $request->date : null;

        $paginator = Activity::with('causer', 'subject')
        ->when($search, function ($query, $search) {
            $query->whereLike(['causer.first_name', 'causer.last_name', 'causer.email', 'event', 'log_name'], $search);
        })
        ->when($date, function ($query, $date) {
            $query->whereDate('created_at', $date);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        $paginator->getCollection()->transform(function ($log, $key) { // @phpstan-ignore-line
            return[
                'id' => $log->id,
                'type' => $log->log_name,
                'event' => $log->event,
                'type_date' => $log->subject ? $log->subject->created_at : null, // @phpstan-ignore-line
                'description' => $log->description,
                'user' => $log->causer ? $log->causer->full_name : null, // @phpstan-ignore-line
                'created_at' => $log->created_at,
                'history' => $log->properties,
            ];
        });

        return $paginator;
    }
}
