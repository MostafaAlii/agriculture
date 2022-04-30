<?php

namespace App\Notifications;

use App\Models\Data;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewData extends Notification
{
    use Queueable;

    public $data;
    public function __construct(Data $data)
    {
        $this->data = $data;
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
    // $url = 'http://127.0.0.1:8000/dashboard_admin/admin/profile/'.$this->admin->id;
    return (new MailMessage)
                ->subject('اضافه منتجات جديده')
                ->line('اضافه منتجات جديده')
                // ->action('عرض تفاصيل', $url)
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
