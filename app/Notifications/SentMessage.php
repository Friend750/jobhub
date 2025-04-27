<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SentMessage extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public $message;
    public $user;
    public $conversation;
    public $receiverId;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$message, $conversation,$receiverId)
    {
        $this->user = $user;
        $this->conversation = $conversation;
        $this->message = $message;
        $this->receiverId = $receiverId;
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
        return
        [
        'user_id' => $this->user->id,
        'message' => $this->message->id,
        'conversation_id' => $this->conversation->id,
        'receiver_id' => $this->receiverId,
        ];

    }
    public function broadcastOn()
    {
        Log::info('Broadcasting on private channel: users.' . $this->receiverId);
        return new PrivateChannel('users.' . $this->receiverId);
    }

}
