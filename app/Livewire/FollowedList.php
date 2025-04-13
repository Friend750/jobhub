<?php

namespace App\Livewire;

use App\Livewire\Traits\ConnectionTrait;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FollowedList extends Component
{
    use ConnectionTrait;
    public $type = 'user'; // or 'company'
    public $perPage = 20;
    public $hasMoreUsers = false;
    public $hasMoreCompanies = false;
    public $users;
    public $user;

     public function mount($id = 0, $type = 'user')
    {
        $this->type = $type;

        if($id != 0)
        {
            $this->user = User::find($id);
        }
        else
        {
            $this->user = Auth::user();
        }
        $this->loadData();
    }

    public function loadMore()
    {
        $this->loadData();
        $this->perPage += 20;
    }

    public function switchTypeLoadData($type)
    {
        $this->perPage = 20;
        $this->switchType($type);
        $this->loadData();
    }

    public function switchType($type)
    {
        $this->type = $type;
    }
    public function loadData()
    {
        $followedIds = Connection::where('following_id', $this->user->id)
        ->where('is_accepted', 1)
        ->pluck('follower_id');

    $results = User::whereIn('id', $followedIds)
        ->where('type', $this->type)
        ->withCount('acceptedAllFollowers')
        ->orderByDesc('accepted_all_followers_count')
        ->take($this->perPage + 1)
        ->get()
        ->values();

        if($this->type == 'user')
        {
            $this->hasMoreUsers = ($results->count() > $this->perPage); // Check if there are more records
        }
        else
        {
            $this->hasMoreCompanies = ($results->count() > $this->perPage); // Check if there are more records
        }
        $this->users = $results->take($this->perPage);
    }


    public function render()
    {


        return view('livewire.followed-list', [
            'users' => $this->users,
        ]);
    }

}
