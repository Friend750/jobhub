<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\Conversation;
use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use App\Livewire\Traits\ConnectionTrait;
use Livewire\Component;

class Search extends Component
{
    use ConnectionTrait;
    #[Title('Search')]
    public $paginateVarPeople = 5;
    public $paginateVarCompanies = 5;
    public $hasMorePeople = false;
    public $hasMoreCompanies = false;
    public $people;
    public $companies;
    public $query;



    public function mount()
    {
        $this->query = session('searchQuery', '');
        $this->loadPeople();
        $this->loadCompany();
    }


    public function loadMorePeople()
    {
        $this->paginateVarPeople += 5; // Increase the limit
        $this->loadPeople(); // Reload the data
    }
    public function loadMoreCompanies()
    {
        $this->paginateVarCompanies += 5; // Increase the limit
        $this->loadCompany(); // Reload the data
    }

    public function loadPeople()
    {
        $results = User::where('user_name', 'like', '%' . $this->query . '%')
            ->where('user_name', '!=', Auth::user()->user_name)
            ->where('type', 'user')
            ->take($this->paginateVarPeople + 1) // Fetch one extra record to check for more pages
            ->get()
            ->values();
        $this->hasMorePeople = $results->count() > $this->paginateVarPeople; // Check if there are more records
        $this->people = $results->take($this->paginateVarPeople); // Only take the current page's data
    }

    public function loadCompany()
    {
        $results = User::where('user_name', 'like', '%' . $this->query . '%')
            ->where('user_name', '!=', Auth::user()->user_name)
            ->where('type', 'company')
            ->take($this->paginateVarCompanies + 1) // Fetch one extra record to check for more pages
            ->get()
            ->values();
        $this->hasMoreCompanies = $results->count() > $this->paginateVarCompanies; // Check if there are more records
        $this->companies = $results->take($this->paginateVarCompanies); // Only take the current page's data
    }


    public function render()
    {
        return view('livewire.search');
    }
}
