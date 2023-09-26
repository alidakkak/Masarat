<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
//use Otp;

class AcceptProjectInviationNotification extends Notification
{
    use Queueable;
    public $message;
    public $fromEmail;
    public $subject;
    public $mailer;
    public $project;
    public $sprint;
    public $role;
    public $pui;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project, $sprint ,$role, $pui)
    {
        $this->project = $project;
        if($sprint != null){
            $this->sprint = $sprint;
        }
        $this->pui = $pui;
        $this->role = $role;
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
        $msg ="You Have Been Added As " . $this->role->name . " Of The Project " . $this->project->name;
        if($this->sprint != null){
            $msg = "You Have Been Added As " . $this->role->name . " Of The Project " . $this->project->name . " ,Sprint " . $this->sprint->name;
        }
        return (new MailMessage)
            ->mailer('smtp')
            ->subject("Project Inviation!")
            ->greeting('Hello '.$notifiable->name)
            ->line($msg)
            ->line("Please Accept By Clicking This Link")
            ->line("https://the-plan.com/project/". $this->project->id ."/accept/" . $this->pui);
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
