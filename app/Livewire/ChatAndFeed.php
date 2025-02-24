<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;

class ChatAndFeed extends Component
{

    public $chats;
    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->chats = Conversation::with([
            'firstUser:id,user_name,user_image',
            'secondUser:id,user_name,user_image'
        ])
            ->where(function ($query) {
                $query->where('first_user', auth()->id())
                    ->orWhere('second_user', auth()->id());
            }) // Only fetch conversations where the user is a participant
            ->orderBy('updated_at', 'asc')
            ->take(3)
            ->get(['id', 'first_user', 'second_user', 'last_message'])
            ->map(function ($conversation) {
                $otherUser = auth()->id() === $conversation->first_user
                    ? $conversation->secondUser
                    : $conversation->firstUser;

                return [
                    'id' => $conversation->id,
                    'name' => $otherUser->user_name,
                    'last_message' => $conversation->last_message,
                    'profile' => $otherUser->user_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->user_name),
                ];
            })
            ->toArray();
    }


    public function render()
    {
        return view('livewire.chat-and-feed');
    }
}
