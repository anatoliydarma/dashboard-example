<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActivityLogController extends Controller
{
    public function index(Request $request, ActivityLogService $activityLogService)
    {
        return Inertia::render('ActivityLog/Index', [
            'logs' => $activityLogService->getActivityLogs($request),
            'filters' => $request->except('page'),
        ]);
    }
}
