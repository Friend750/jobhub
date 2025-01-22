<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class CompanyList extends Component
{
    #[Title('Companies')]
    public $companies;
    public function mount()
{
    $user = User::find(auth()->user()->id);


    $this->companies = $user->companies()->with('experiences', 'page')->get()->map(function ($follower) 
    {
        return [
            'id' => $follower->id,
            'user_name' => $follower->user_name,
            'position' => optional($follower->page)->description,
            'user_image' => $follower->user_image ?? null,
        ];
    })->toArray();
    
   
}    

    public function render()
    {
        return view('livewire.company-list');
    }
}
