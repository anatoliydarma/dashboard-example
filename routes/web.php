<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ConciergeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GrowthController;
use App\Http\Controllers\ManifestController;
use App\Http\Controllers\MetricsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth', 'verified', 'otp', 'on'])->group(function () {
    Route::get('one-day-view', [BookingController::class, 'oneDayView'])->name('one.day.view');

    Route::put('booking-update', [BookingController::class, 'update'])->name('booking.update');

    Route::get('fetching-data', [BookingController::class, 'fetchingData'])->name('fetchingData');

    Route::get('date-range-view', [BookingController::class, 'indexDateRangeView'])->name('date-range-view');

    Route::put('day-update', [BookingController::class, 'dayDataUpdate'])->name('day.update');

    Route::put('day-update-start', [BookingController::class, 'dayDataUpdateStartOfDate'])->name('day.update.start');

    Route::resource('order', OrderController::class)->except('show', 'index', 'edit', 'create');

    Route::get('metrics', [MetricsController::class, 'index'])->name('metrics');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('manifest', [ManifestController::class, 'index'])->name('manifest.index');
    Route::get('download-manifest', [ManifestController::class, 'download'])->name('download.manifest');
    Route::get('download-booking', [BookingController::class, 'download'])->name('download.booking');

    Route::post('booking/import', [BookingController::class, 'importFile'])->name('booking.import');

    Route::resource('concierges', ConciergeController::class);

    Route::middleware(['role:manager'])->group(function () {
        Route::get('growth', [GrowthController::class, 'index'])->name('growth');
    });
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/tickets', [SettingController::class, 'store'])->name('settings.tickets.store');
        Route::put('settings/tickets', [SettingController::class, 'update'])->name('settings.tickets.update');
        Route::delete('settings/tickets', [SettingController::class, 'destroy'])->name('settings.tickets.destroy');

        Route::resource('activity-logs', ActivityLogController::class);

        Route::post('clean-cache', [SettingController::class, 'cleanCache'])->name('clean.cache');

        Route::post('settings/sync', [SettingController::class, 'getDataFromProd'])->name('settings.sync');
    });
});

require __DIR__.'/auth.php';
