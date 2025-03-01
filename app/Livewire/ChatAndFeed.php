<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatAndFeed extends Component
{

    public $chats;
    public $suggestions;
    public function mount()
    {
        $this->loadChats();
        $this->loadSuggestions();
    }

    public function loadChats()
    {


        $this->chats =  Conversation::with([
                    'firstUser:id,user_name,user_image',
                    'secondUser:id,user_name,user_image'
                ])
                ->where(function ($query) {
                    $query->where('first_user', auth()->id())
                        ->orWhere('second_user', auth()->id());
                })
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

    public function unFollow($connectionId)
{
        // البحث عن السجل المرتبط بالمستخدم الحالي وحذفه باستخدام Soft Delete
             DB::table('connections')
            ->where('follower_id',$connectionId) // المستخدم الحالي هو المتابع
            ->where('following_id',  Auth::id()) // ID الذي تم تمريره
            ->delete(); // Soft Delete


    $this->dispatch('connectionUpdated');
}


public function follow($connectionId)
{

        $receiver = $this->getUserById($connectionId);

        DB::table('connections')->insert([
            'follower_id' => $connectionId,
            'following_id' => Auth::id(),
            'is_accepted' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $receiver->notify(new Request( auth()->user(),$receiver));

}

    public function loadSuggestions()
    {
       // الحصول على المستخدم المصادق
    $user = Auth::user();

    // الحصول على اهتمامات المستخدم
    $userInterests = $user->interests;

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


    }

    public function getUserById($receiverId)
    {
    return User::find($receiverId);
    }

    public function render()
    {
        return view('livewire.chat-and-feed');
    }
}
