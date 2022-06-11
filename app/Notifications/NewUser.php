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

    // public $user;
    // public function __construct(User $user)
    // {
    //     $this->user = $user;
    // }
    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //     ->greeting($this->details['greeting'])
    //     ->line($this->details['body'])
    //     ->action($this->details['actionText'], $this->details['actionURL'])
    //     ->line($this->details['thanks'])
    //         ->subject(__('Admin/site.new_user_registration'))
    //         ->greeting(__('Admin/site.hello'))
    //         ->line(__('Admin/site.new_user_registration_message'))
    //         ->line(__('Admin/site.user_name').': '.$this->details['name'])
    //         ->line(__('Admin/site.user_email').': '.$this->details['email'])
    //         ->line(__('Admin/site.user_phone').': '.$this->details['phone'])
    //         ->action(__('Admin/site.login_now'), url('/login'))
    //         ->line(__('Admin/site.thank_you_for_using_our_application'));
    // }
    public function toMail($notifiable)
    {
    $url = 'http://127.0.0.1:8000/user/dashboard';
    return (new MailMessage)
                ->subject('اضافة مستخدم جديد')
                ->line('اضافه مستخدم جديد')
                ->action('عرض تفاصيل', $url)
                ->line('شكرا لاستخدامك مورا سوفت ');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
