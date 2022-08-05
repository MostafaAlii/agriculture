<?php

namespace App\Notifications;

use App\Models\Farmer;
use App\Models\email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEmails extends Notification
{
    use Queueable;

    public $email;
    public function __construct($email)
    {
        $this->email = $email;
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
    // $url = 'http://127.0.0.1:8000/home.email';
    return (new MailMessage)
                ->subject('مشترك جديد')
                ->line('مشترك جديد')
                ->greeting($this->project['greeting'])
                ->line($this->project['body'])
                ->line('شكرا لاستخدامك مورا سوفت ')
                ->line($this->project['thanks']);
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
