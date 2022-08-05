<?php
namespace App\Console;
use Illuminate\Support\Facades\Log;
use App\Console\Commands\notifyFarmer;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Subscriptions\SubscripetionExperiedNotification;

class Kernel extends ConsoleKernel {
    protected $commands = [
        SubscripetionExperiedNotification::class,
        notifyFarmer::class,
    ];
    protected function schedule(Schedule $schedule) {
        $schedule->command('subscription:SubscripetionExperiedNotification')->lastDayOfMonth();

        //Log::info('start run this schedule daily');
        $schedule->command('farmer:notify_expire_offer')->daily();
    }

    protected function commands() {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }

    protected function scheduleTimezone() {
        return 'Asia/Baghdad';
    }
}
