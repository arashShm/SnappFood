<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewShop extends Notification
{
    use Queueable;
    private $email = null ;
    private $pass = null ;



    public function __construct($username , $pass)
    {
        $this->email = $username ;
        $this->pass = $pass;
    }




    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Dear User')
                    ->line('You have sign up has completed')
                    ->line('Enter the link below and Change your password for more safety')
                    ->line("your password : $this->pass your Username : $this->email ")
                    ->action('Enter your account!!', url('/login'))
                    ->line('Thank you for using our application!');
    }


    
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
