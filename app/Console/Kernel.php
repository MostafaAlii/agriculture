<?php
namespace App\Console;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Subscriptions\SubscripetionExperiedNotification;
class Kernel extends ConsoleKernel {
    protected $commands = [
        SubscripetionExperiedNotification::class,
    ];
    protected function schedule(Schedule $schedule) {
        $schedule->command('subscription:SubscripetionExperiedNotification')->lastDayOfMonth();
    }

    protected function commands() {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }

    protected function scheduleTimezone() {
        return 'Asia/Baghdad';
    }
}