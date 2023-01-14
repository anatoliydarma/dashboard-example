<?php

namespace App\Console;

use App\Services\VentrataService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            app(VentrataService::class)->pullBookings();
        })->dailyAt('07:00');

        $schedule->command('backup:run --only-db')->dailyAt('02:00');

        $schedule->command('activitylog:clean --days=90')->weeklyOn(0, '3:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
