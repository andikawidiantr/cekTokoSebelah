<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    use Queueable;
    protected $data;

   /** 
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Get the mail representation of the notification.
     * 
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail ($notifiable)
    {
        return (new Mailmessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action',url('/'))
            ->line('Terima Kasih sudah menggunakan Aplikasi kami! :)');
    }

    /**
     * Get the Array representation of the notification.
     * 
     * @param mixed $notifiable
     * @return array
     */

    public function toArray($notifiable)
    {
        return $this->data;
    }
}

