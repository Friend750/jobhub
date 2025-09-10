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

        $user = Auth::user();

        $this->followings = $user->acceptedFollowings()->with('personal_details')->get()->map(function ($following) {
            return [
                'id' => $following->id,
                'name' => $following->fullName(),
                'position' => $following->personal_details->specialist ?? null,
                'user_image' => $following->user_image_url ?? null,
            ];
        })->toArray();
    }


    public function render()
    {
        return view('livewire.following-screen');
    }
}
