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
                ->Where('user_name', 'LIKE', '%' . $this->query . '%')
                ->orderByDesc('views') // تأكد من وجود حقل views_count في جدول المستخدمين
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
    public function render()
    {
        return view('livewire.searchbar');
    }
}
