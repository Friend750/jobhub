<?php

namespace App\Livewire;

use Livewire\Component;

class UserProfile extends Component
{
    public $skills =[];

    public function mount(){
        $this->skills =[
            'skill 1','skill 2','skill 3','skill 4','skill 5',
            'skill 6','skill 6','skill 7','skill 8','skill 9','skill 10'
            ,'skill 11','skill 12','skill 13','skill 14','skill 15'
        ];
    }

    public function render()
    {
        return view('livewire.user-profile',['skills' => $this->skills]);
    }
}
