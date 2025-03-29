<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Experience;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowingScreen extends Component
{
    #[Title('Following')]
    public $followings;


    public function getFollowStatus($userId)
{
    $connection = Connection::where('follower_id', $userId)
    ->where('following_id', Auth::id())
    ->first();


    return [
        'isFollowing' => $connection && $connection->is_accepted == 1, // Active following
        'isRequested' => $connection && $connection->is_accepted == 0, // Pending request
    ];
}

public function mount()
{

    $user = User::find(Auth::user()->id);

    $this->followings = $user->acceptedFollowings()->with('experiences')->get()->map(function ($follower) {
        return [
            'id' => $follower->id,
            'user_name' => $follower->user_name,
            'position' => optional($follower->experiences->sortByDesc('created_at')->first())->job_title,
            'user_image' => $follower->user_image ?? null,
        ];
    });
}

public function unFollow($connectionId)
{
    Connection::where('follower_id', $connectionId)
    ->where('following_id', Auth::id())
    ->delete();

    $this->dispatch('connectionUpdated');
}


public function follow($connectionId)
{

    $receiver = User::find($connectionId);
    Connection::create([
        'follower_id' => $connectionId,
        'following_id' => Auth::id(),
        'is_accepted' => 0
    ]);
    $receiver->notify(new Request(Auth::user(),$receiver));

}
public function showUser($id){
    return redirect()->route('user-profile', $id);
}


    public function render()
    {
        return view('livewire.following-screen');
    }
}
