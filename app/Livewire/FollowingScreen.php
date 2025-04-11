<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Experience;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Traits\ConnectionTrait;

class FollowingScreen extends Component
{
    use ConnectionTrait;
    #[Title('Following')]
    public $followings;




public function mount()
{

    $user = User::find(Auth::user()->id);

    $this->followings = $user->acceptedFollowings()->with('experiences')->get()->map(function ($following) {
        return [
            'id' => $following->id,
            'name' => $following->fullName(),
            'position' => optional($following->experiences->sortByDesc('created_at')->first())->job_title,
            'user_image' => $following->user_image ?? null,
        ];
    });
}


    public function render()
    {
        return view('livewire.following-screen');
    }
}
