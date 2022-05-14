<?php

namespace App\Notifications;

use App\Models\Farmer;
use App\Models\Worker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewWorker extends Notification
{
    use Queueable;

    public $worker;
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
    $url = 'http://127.0.0.1:8000/home.worker';
    return (new MailMessage)
                ->subject('اضافه عامل جديد')
                ->line('اضافه عامل جديد')
                ->action('عرض تفاصيل', $url)
                ->line('شكرا لاستخدامك مورا سوفت ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
