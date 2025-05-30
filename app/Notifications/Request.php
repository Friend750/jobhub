<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Request extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public $user;
    public $receiver;
    public $personalDetails;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$receiver,$personalDetails)
    {
        $this->user = $user;
        $this->receiver = $receiver;
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
        return
        [
        'user_id' => $this->user->id,
        'receiver_id' => $this->receiver->id,
        'personalDetails' => $this->personalDetails,

        ];

    }

public function broadcastOn()
{
    // هنا نحدّد القناة الخاصة بالـ receiverId
    return new PrivateChannel('users.' . $this->receiver->id);
}
}
