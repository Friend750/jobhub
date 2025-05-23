<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Like extends Notification
{
    use Queueable;

    public $user;
    public $receiverId;
    public $post;
    public $personalDetails;
   /**
     * Create a new notification instance.
     */
    public function __construct($user,$personalDetails, $receiverId,$post)
    {
        $this->user = $user;
        $this->receiverId = $receiverId;
        $this->post = $post;
        $this->personalDetails = $personalDetails;

    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => $this->user,
            'receiverId' => $this->receiverId,
            'post' => $this->post,
            'post_type' => class_basename($this->post),
            'personalDetails' => $this->personalDetails,


        ];
    }

    public function broadcastOn()
    {
        // هنا نحدّد القناة الخاصة بالـ receiverId
        return new PrivateChannel('users.' . $this->receiverId);
    }
}
