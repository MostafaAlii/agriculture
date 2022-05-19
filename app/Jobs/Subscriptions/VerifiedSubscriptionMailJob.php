<?php

namespace App\Jobs\Subscriptions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VerifiedSubscriptionMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $ex_subscription, $expired_date;
    public function __construct($ex_subscription,$expired_date) {
        $this->ex_subscription  =       $ex_subscription;
        $this->expired_date     =       $expired_date;
    }

    public function handle()
    {
        info('i am here in VerifiedSubscriptionMailJob');
        // send mail for expired user
        sendMail('front.emails.subscriptions.expired', $this->ex_subscription->email,
         trans('Website/subscriptions.email_expired_subject'), $this->ex_subscription);
        info('i email Was Sent');
    }
}
