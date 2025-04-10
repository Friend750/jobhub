<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Searchbar extends Component
{
    public $query = ''; // Public variable to bind the search input


    public $results = [];
    public $showDropdown = false;

    protected $listeners = ['hideDropdown' => 'hideDropdown'];

    public function updatedQuery()
    {
        if (strlen($this->query) > 1) {
            $this->results = User::query()
                ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
                ->where(function ($query) {
                    $query->where('personal_details.first_name', 'LIKE', '%' . $this->query . '%')
                          ->orWhere('personal_details.last_name', 'LIKE', '%' . $this->query . '%');
                })
                ->orderByDesc('views') // Make sure `views` column is in the users table
                ->select('users.*') // Make sure to select users' fields only
                ->take(4)
                ->get();

            $this->showDropdown = true;
        } else {
            $this->results = [];
            $this->showDropdown = false;
        }

    }

    public function selectUser($userId)
    {
        $user = User::find($userId);
        $this->query = $user->name;
        $this->showDropdown = false;
    }

    public function search()
    {
        // Handle the search logic or redirect with the query
        session(['searchQuery' => $this->query]);
        $this->showDropdown = false;
        // Optionally redirect to another page
        return redirect()->route('search');
    }


    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function showUser($id){
        return redirect()->route('user-profile', $id);
    }
    public function render()
    {
        return view('livewire.searchbar');
    }
}
