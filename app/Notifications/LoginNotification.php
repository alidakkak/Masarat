<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
//use Otp;

class LoginNotification extends Notification
{
    use Queueable;
    public $message;
    public $fromEmail;
    public $subject;
    public $mailer;
    public $ip;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ip)
    {
        $this->ip = $ip;
        $this->fromEmail = "smtp.gmail.com";
        $this->mailer = "smtp";
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
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->mailer('smtp')
            ->subject("Login Alert!")
            ->greeting('Hello '.$notifiable->name)
            ->line("Someone logged in to your account from this ip" . $this->ip)
            ->line("if this is not you please change your password here")
            ->line("https://the-plan.com/dashboard/profile");
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
