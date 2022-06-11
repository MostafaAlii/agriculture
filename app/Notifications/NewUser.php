<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUser extends Notification
{
    use Queueable;

    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
    $url = 'http://127.0.0.1:8000/home';
    return (new MailMessage)
                ->subject(__('Admin/site.add_new_user'))
                ->view( 'front.emails.subscriptions.notyuseremail', ['user' => $this->user]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
