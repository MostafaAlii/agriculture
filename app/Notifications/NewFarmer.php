<?php

namespace App\Notifications;

use App\Models\Farmer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewFarmer extends Notification
{
    use Queueable;

    public $farmer;
    public function __construct(Farmer $farmer)
    {
        $this->farmer = $farmer;
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
    $url = 'http://127.0.0.1:8000/dashboard_admin/farmer/profile/'.$this->farmer->id;
    return (new MailMessage)
                ->subject('اضافة فلاح جديد')
                ->line('اضافة فلاح جديد')
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
