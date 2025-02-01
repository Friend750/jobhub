<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class SelectInterests extends Component
{
    #[Title('Interests')]
    public $interests = [
        'Marketing',
        'Technology',
        'Economy',
        'Business',
        'Administration',
        'E-commerce',
        'IT Management',
        'Software Development',
        'Web Development',
        'Mobile Development',
        'Data Science',
        'Artificial Intelligence',
        'Cybersecurity',
        'Game Development',
    ];
    public $selectedInterests = [];
    public $userId; // معرف المستخدم

    public function mount()
    {
        $this->userId = auth()->id(); // استخدم معرف المستخدم المسجل
    }

    public function nextStep()
    {
        $user = User::find($this->userId); // Resolve the user using the stored user ID
        if (count($this->selectedInterests) < 2) {
            session()->flash('error', __('general.error_interests'));
            return;
        }
        else
        {
            $user->interests = $this->selectedInterests;
            $user->save();
            redirect('EnhanceProfile');
        }
        // تنفيذ عملية التخزين أو الانتقال للخطوة التالية

    }

    public function render()
    {
        return view('livewire.select-interests');
    }
}

