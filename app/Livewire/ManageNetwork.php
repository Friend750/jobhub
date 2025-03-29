<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageNetwork extends Component
{
    public $countFollowers;
    public $countFollowings;
    public $countCompanies;


    protected $listeners = ['connectionUpdated' => 'refreshNetwork'];
   public function mount()
   {
    $this->refreshNetwork();
   }
   public function refreshNetwork()
    {
        $user = User::find(Auth::user()->id);
        $this->countCompanies = $user->companies()->count();
        $this->countFollowings = $user->acceptedFollowings()->count();
        $this->countFollowers = $user->acceptedFollowers()->count();
    }

    public function render()
    {
        return view('livewire.manage-network');
    }
}
