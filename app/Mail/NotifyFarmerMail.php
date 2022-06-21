<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyFarmerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    public function __construct($products)
    {
        $this->products=$products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->subject("اشعار بانتهاء مده العرض للمنتجات الخاصه بكم")
                ->view('front.emails.notify_farmer')->with([
                        'products'=>$this->products
                    ]);
    }
}
