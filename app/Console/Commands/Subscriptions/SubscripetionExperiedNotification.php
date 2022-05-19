<?php
namespace App\Console\Commands\Subscriptions;
use App\Models\Subscription;
use App\Jobs\Subscriptions\SendExpiredSubscriptionMailJob;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
class SubscripetionExperiedNotification extends Command {
    protected $signature        =       'subscription:SubscripetionExperiedNotification';
    protected $description      =       'Command For User email subscripe date was been expired';
    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $expired_subscriptions = Subscription::expireSubscribeDate()->get();
        $verified_subscriptions = Subscription::OnlyNotExpiredDate()->get();
        foreach($expired_subscriptions as $ex_subscription) {
            info('i am here in SubscripetionExperiedNotification Using Scheduling' . Carbon::now());
            $expired_date = Carbon::createFromFormat('Y-m-d H:i:s', $ex_subscription->subscription_end_date)->toDateString();
            dispatch(new SendExpiredSubscriptionMailJob($ex_subscription, $expired_date));
        }
        foreach($verified_subscriptions as $vr_subscription) {
            info('i am here in SubscripetionExperiedNotification Using Scheduling' . Carbon::now());
            $verified_date = Carbon::createFromFormat('Y-m-d H:i:s', $vr_subscription->subscription_end_date)->toDateString();
            //dispatch(new SendExpiredSubscriptionMailJob($vr_subscription, $expired_date));
        }
        $this->call('queue:work');
    }
}
