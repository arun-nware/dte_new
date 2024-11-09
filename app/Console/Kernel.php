<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->command('app:update-payment-transaction-command')->everyMinute();
         $schedule->command('app:send-notification-for-godown-payment-command')->everyMinute();
         $schedule->command('app:generate-reverse-mis-for-godown-payment-command')->dailyAt('8:30')->timezone('Asia/Kolkata');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
