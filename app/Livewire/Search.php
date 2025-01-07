<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Search extends Component
{
    #[Title('Search')]
    public $activeTab = 'people'; // العنصر النشط افتراضيًا

    public function switchTab($tab)
    {
        $this->activeTab = $tab; // تحديث العنصر النشط
    }
    public $people = [
        ['id' => 1, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],
        ['id' => 2, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => true],
        ['id' => 3, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],
        ['id' => 4, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => true],
        ['id' => 5, 'name' => 'Ali Qayed', 'position' => 'Software Engineer at Google / Ex-SED Amazon', 'is_following' => false],

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
