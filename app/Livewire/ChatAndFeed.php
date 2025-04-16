<?php

namespace App\Livewire;

use App\Livewire\Traits\ConnectionTrait;
use App\Models\Connection;
use App\Models\Conversation;
use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatAndFeed extends Component
{
    use ConnectionTrait;

    public $chats;
    public $suggestions;
    public function mount()
    {
        $this->loadChats();
        $this->loadSuggestions();
    }

    public function loadChats()
    {


        $this->chats = Conversation::with([
            'firstUser:id,user_name,user_image',
            'secondUser:id,user_name,user_image'
        ])
            ->where(function ($query) {
                $query->where('first_user', Auth::id())
                    ->orWhere('second_user', Auth::id());
            })
            ->orderBy('updated_at', 'asc')
            ->take(3)
            ->get(['id', 'first_user', 'second_user', 'last_message'])
            ->map(function ($conversation) {
                $otherUser = Auth::id() === $conversation->first_user
                    ? $conversation->secondUser
                    : $conversation->firstUser;

                return [
                    'id' => $conversation->id,
                    'last_message' => $conversation->last_message,
                    'profile' => $otherUser->user_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($otherUser->user_name),
                    'full_name' =>  $otherUser->fullName(),
                ];
            })
            ->toArray();
    }



    public function loadSuggestions()
    {
        // الحصول على المستخدم المصادق
        $user = Auth::user();

        // الحصول على اهتمامات المستخدم
        $userInterests = $user->interests;

      // الاقتراحات بناءً على الاهتمامات
$this->suggestions = User::where('id', '!=', $user->id)
->where(function ($query) use ($userInterests) {
    foreach ($userInterests as $interest) {
        $query->orWhereJsonContains('interests', $interest);
    }
})
->whereDoesntHave('connections', function ($query) use ($user) {
    $query->where('following_id', $user->id);
})
->with('personal_details')
->orderBy('views', 'desc')
->take(3)
->get();

if ($this->suggestions->isEmpty()) {
$this->suggestions = User::where('id', '!=', $user->id)
    ->whereDoesntHave('connections', function ($query) use ($user) {
        $query->where('following_id', $user->id);
    })
    ->with('personal_details')
    ->orderBy('views', 'desc')
    ->take(3)
    ->get();
}


    }



    public function render()
    {
        return view('livewire.chat-and-feed');
    }
}
