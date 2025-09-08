<?php

namespace App\Livewire;

use App\Livewire\Traits\ConnectionTrait;
use App\Models\Connection;
use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class CompanyList extends Component
{
    use ConnectionTrait;
    #[Title('Companies')]
    public $companies;

    public function mount()
    {

         $this->companies = Auth::user()->getCompaniesData();

    }

    public function render()
    {
        return view('livewire.company-list');
    }
}
