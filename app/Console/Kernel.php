<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\AbsensiController;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->call([AbsensiController::class, 'syncData'])->everyMinute();

        // $schedule->call(function () {
        //     // Your task logic here
        // })->name('Callback')->everyMinute();


        $schedule->call([new AbsensiController, 'syncData'])->hourly();
        // $schedule->call([new AbsensiController, 'syncData'])->everyMinute();
        // $schedule->call([new AbsensiController, 'runTask'])->dailyAt('09:00');
        // $schedule->call([new AbsensiController, 'runTask'])->dailyAt('12:00');



        // $schedule->call([AbsensiController::class, 'runTask'])
        //      ->dailyAt('09:00') // Run at 9 AM
        //      ->dailyAt('12:00'); // Run at 12 PM

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
