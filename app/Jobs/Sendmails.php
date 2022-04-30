<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class Sendmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
       $this->data = $data;
    }


    public function handle()
    {
        foreach($this->data as $data){
            // \Mail::to($data->email())->send(new MailableClass);
            Notification::send($data->email, new \App\Notifications\NewData($data->email));
        }
    }
}
