<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class FollowersScreen extends Component
{
    #[Title('Followers')]
    public $followers;
    public function mount()
{
    $user = User::find(Auth::user()->id);

    $this->followers = $user->acceptedFollowers()
    ->with('experiences')
    ->get()
    ->map(function ($follower) {
        return [
            'id' => $follower->id,
            'user_name' => $follower->user_name,
            'position' => optional($follower->experiences->sortByDesc('created_at')->first())->job_title ?? 'No Position',
            'user_image' => $follower->user_image ?? null,
        ];
    })->toArray();

}

public function deleteConnection($connectionId)
    {
        $deleted = Connection::where('follower_id', Auth::id())
        ->where('following_id', $connectionId)
        ->delete();

        if ($deleted)
         {
                 session()->flash('message', 'Connection deleted successfully!');
         }
         else
         {
        session()->flash('error', 'Connection not found or already deleted!');
         }

$this->dispatch('connectionUpdated');

    }

public function startConversation($userId)
{
    $conversation = Conversation::where(function ($query) use ($userId) {
        $query->where('first_user', Auth::id())
              ->where('second_user', $userId);
    })
    ->orWhere(function ($query) use ($userId) {
        $query->where('first_user', $userId)
              ->where('second_user', Auth::id());
    })
    ->first();

if (!$conversation) {
    // إذا لم تكن المحادثة موجودة، قم بإنشائها
    $conversation = Conversation::create([
        'first_user' => Auth::id(),
        'second_user' => $userId,
    ]);
}
    // التوجيه إلى شاشة المحادثة
        return redirect()->route('chat', ['conversationId' => $conversation->id]);
}

public function showUser($id){
    return redirect()->route('user-profile', $id);
}

    public function render()
    {
        return view('livewire.followers-screen');
    }
}
