<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Livewire\Traits\ConnectionTrait;
use Livewire\Attributes\Title;
use Livewire\Component;

class FollowersScreen extends Component
{
    use ConnectionTrait;
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
            'name' => $follower->fullName(),
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





    public function render()
    {
        return view('livewire.followers-screen');
    }
}
