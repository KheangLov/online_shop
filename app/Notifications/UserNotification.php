<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
            'messages' => $this->details['body'],
            'user_id' => $this->details['user_id'],
            'user_name' => $this->details['user_name']
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'messages' => $this->details['body'],
            'user_id' => $this->details['user_id'],
            'user_name' => $this->details['user_name']
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'messages' => $this->details['body'],
            'user_id' => $this->details['user_id'],
            'user_name' => $this->details['user_name']
        ];
    }
}