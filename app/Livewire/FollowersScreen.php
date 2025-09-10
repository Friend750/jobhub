<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Livewire\Traits\ConnectionTrait;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

class FollowersScreen extends Component
{
    use ConnectionTrait;
    #[Title('Followers')]
    public $followers;
    public function mount()
    {
        $user = Auth::user();

        $this->followers = $user->acceptedFollowers()
            ->with('personal_details')
            ->get()
            ->map(function ($follower) {
                return [
                    'id' => $follower->id,
                    'name' => $follower->fullName(),
                    'position' => $follower->personal_details->specialist,
                    'user_image' => $follower->user_image_url ?? null,
                ];
            })->toArray();

    }

    public function deleteUserConnection($connectionId)
{
    try {
        $deleted =  Auth::user()->followers()->detach($connectionId);


        if ($deleted) {
            session()->flash('message', 'Connection deleted successfully!');
        } else {
            session()->flash('error', 'Connection not found or already deleted!');
        }
    } catch (\Exception $e) {
        session()->flash('error', 'An error occurred while deleting connection.');
        Log::error("Delete connection failed: " . $e->getMessage());
    }

    $this->dispatch('connectionUpdated');
}






    public function render()
    {
        return view('livewire.followers-screen');
    }
}
