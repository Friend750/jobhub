<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    ->where('users.id', '!=', Auth::id()) // استبعاد المستخدم الحالي
    ->where(function ($query) {
        $query->where(function ($q) {
            $q->where('users.type', 'user')
              ->where(function ($qq) {
                  $qq->where('personal_details.first_name', 'LIKE', '%' . $this->query . '%')
                     ->orWhere('personal_details.last_name', 'LIKE', '%' . $this->query . '%');
              });
        })->orWhere(function ($q) {
            $q->where('users.type', 'company')
              ->where('personal_details.page_name', 'LIKE', '%' . $this->query . '%');
        });
    })
    ->orderByDesc('views')
    ->select('users.*')
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
