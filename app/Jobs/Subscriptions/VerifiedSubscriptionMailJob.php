<?php

namespace App\Jobs\Subscriptions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewEmails;
// use Notification;

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
        $email = [
            'greeting' => 'Hi '.$this->ex_subscription->email.',',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from agro.com',
        ];
        info('i am here in VerifiedSubscriptionMailJob');

         // send mail for not expired user
         sendMail('front.emails.subscriptions.verified', $this->ex_subscription->email,
         trans('Website/subscriptions.email_notexpired_subject'), $this->ex_subscription);
        
        info('Email Send successfully');
    }
}
