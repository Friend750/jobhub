<?php

namespace App\Livewire;

use Livewire\Component;

class SelectInterests extends Component
{
    public $interests = [
        'Marketing',
        'Technology',
        'Economy',
        'Business & Finance',
        'Business Administration',
        'E-commerce',
        'IT Management',
    ];
    public $selectedInterests = [];

    public function toggleInterest($interest)
    {
        if (in_array($interest, $this->selectedInterests)) {
            $this->selectedInterests = array_diff($this->selectedInterests, [$interest]);
        } else {
            $this->selectedInterests[] = $interest;
        }
    }

    public function nextStep()
    {
        if (count($this->selectedInterests) < 2) {
            session()->flash('error', 'Please select at least 2 interests.');
            return;
        }
        // تنفيذ عملية التخزين أو الانتقال للخطوة التالية
        session()->flash('success', 'Interests saved successfully!');
    }

    public function render()
    {
        return view('livewire.select-interests');
    }
}
