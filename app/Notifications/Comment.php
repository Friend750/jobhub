<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Comment extends Notification
{
    use Queueable;

    public $comment;
    public $user;
    public $receiverId;
    public $post;
    public $personalDetails;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$personalDetails,$comment, $receiverId,$post)
    {
        $this->user = $user;
        $this->comment = $comment;
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

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => $this->user,
            'comment' => $this->comment,
            'receiverId' => $this->receiverId,
            'post' => $this->post,
            'personalDetails' => $this->personalDetails,
            'post_type' => class_basename($this->post),
        ];
    }

    public function broadcastOn()
{
    // هنا نحدّد القناة الخاصة بالـ receiverId
    return new PrivateChannel('users.' . $this->receiverId);
}
}
