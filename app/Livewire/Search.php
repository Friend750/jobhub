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
        $currentUserId = Auth::id(); // استبعاد المستخدم الحالي باستخدام ID وهو أدق

        $results = User::query()
            ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
            ->where(function ($query) {
                $query->where('personal_details.first_name', 'LIKE', '%' . $this->query . '%')
                      ->orWhere('personal_details.last_name', 'LIKE', '%' . $this->query . '%');
            })
            ->where('users.id', '!=', $currentUserId)
            ->where('users.type', 'user')
            ->orderByDesc('views') // إذا تحب تحافظ على ترتيب حسب views
            ->select('users.*')
            ->take($this->paginateVarPeople + 1) // Fetch one extra to check for pagination
            ->get()
            ->values();

        $this->hasMorePeople = $results->count() > $this->paginateVarPeople;
        $this->people = $results->take($this->paginateVarPeople);

    }

    public function loadCompany()
    {
        $results = User::query()
        ->join('personal_details', 'users.id', '=', 'personal_details.user_id')
        ->where('users.type', 'company')
        ->where('personal_details.page_name', 'LIKE', '%' . $this->query . '%')
        ->where('users.user_name', '!=', Auth::user()->user_name)
        ->select('users.*') // اختياري: لو تحتاج معلومات إضافية من personal_details عدل هنا
        ->take($this->paginateVarCompanies + 1)
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
