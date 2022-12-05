<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\PackageEarn::class,
    ];

    protected function schedule(Schedule $schedule)
    {
       // $schedule->command('PackageEarn:cron')->timezone('Asia/Colombo')->dailyAt('02:00');
       // $schedule->command('AutoRemoveNotBuyUser:cron')->timezone('Asia/Colombo')->dailyAt('02:00');
       // $schedule->command('WalletDuplicateFind:cron')->timezone('Asia/Colombo')->everyMinute();
       // $schedule->command('backup:run')->daily();

       /* $schedule->call(function () {
            Log::info("cron job is run");
        })->timezone('Asia/Colombo')
          ->dailyAt('02:00');
        */
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
