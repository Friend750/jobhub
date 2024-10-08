<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $people = [
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => true],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => true],
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],

        // Add more people as needed
    ];
 
    public function toggleFollow($id)
    {
        foreach ($this->people as &$person) {
            if ($person['id'] === $id) {
                $person['is_following'] = !$person['is_following'];
            }
        }
    }
    public function render()
    {
        return view('livewire.search');
    }
}
