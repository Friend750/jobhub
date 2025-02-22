<?php

namespace App\Livewire\Forms;

use App\Livewire\EnhanceProfile;
use App\Models\PersonalDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class ProfessionalSummaryForm extends Form
{
    #[Rule('required|string|min:50|max:500')]
    public $description;

    public function oldData()
    {
        $oldData = Auth::user()->personal_details;
        $this->description = $oldData->professional_summary ?? "null";
    }
    public function submit()
    {
        $validated = $this->validate();

        PersonalDetail::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'professional_summary' => $validated['description'],
            ]
        );
        $this->reset();
    }

}
