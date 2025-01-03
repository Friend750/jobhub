<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SelectInterests extends Component
{
    public $interests = [
        'Marketing',
        'Technology',
        'Economy',
        'Business',
        'Administration',
        'E-commerce',
        'IT Management',
      
    ];
    public $selectedInterests = [];
    public $userId; // معرف المستخدم

    public function mount()
    {
        $this->userId = auth()->id(); // استخدم معرف المستخدم المسجل
    }

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
        else
        {
            session()->flash('success', 'Interests saved successfully!');
            $user = User::find($this->userId);
            $user->interests = $this->selectedInterests;
            $user->save();
            session()->flash('success', 'Your interests have been saved successfully!');
            redirect('EnhanceProfile');
        }
        // تنفيذ عملية التخزين أو الانتقال للخطوة التالية
        
    }

    public function render()
    {
        return view('livewire.select-interests');
    }
}

