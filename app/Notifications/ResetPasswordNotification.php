<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Stores the token value from notification
     * 
     * @var string
     */
    protected $token;

    /**
     * User's inserted email address
     * 
     * @var string
     */
    protected $email;

    /**
     * User's name
     */
    protected $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        $url = 'http://127.0.0.1:8000/password/reset/'.$this->token.'?email='.$this->email;
        $count_minutes = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        $greeting = 'Greetings my dear'.$this->name.'!';
        $salutation = "Best warm regards,\n".config('APP_NAME', 'App Team');

        return (new MailMessage)
                ->subject(Lang::get('Reset Password Message'))
                ->greeting($greeting)
                ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
                ->action(Lang::get('Reset Password'), $url)
                ->line(Lang::get('This password reset link will expire in '.$count_minutes.' minutes.'))
                ->line(Lang::get('If you did not request a password reset, no further action is required.'))
                ->salutation($salutation);
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
