<?php

namespace App\Livewire;

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


public function mount()
{

    $user = User::find(auth()->user()->id);

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
        // البحث عن السجل المرتبط بالمستخدم الحالي وحذفه باستخدام Soft Delete
             DB::table('connections')
            ->where('follower_id',$connectionId) // المستخدم الحالي هو المتابع
            ->where('following_id',  Auth::id()) // ID الذي تم تمريره
            ->delete(); // Soft Delete


    $this->dispatch('connectionUpdated');
}


public function follow($connectionId)
{

        $receiver = User::Find($connectionId);

        DB::table('connections')->insert([
            'follower_id' => $connectionId,
            'following_id' => Auth::id(),
            'is_accepted' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $receiver->notify(new Request( auth()->user(),$receiver));

}


    public function render()
    {
        return view('livewire.following-screen');
    }
}
