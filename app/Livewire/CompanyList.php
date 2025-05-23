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

        $user = Auth::user();
        $this->companies = $user->companies()
            ->get()
            ->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->fullName(),
                    'user_image' => $company->user_image_url ?? null,
                    'is_accepted' => $company->pivot->is_accepted, // Include if needed
                    'position' => $company->personal_details->specialist ?? "",
                ];
            })->toArray();

    }

    public function render()
    {
        return view('livewire.company-list');
    }
}
