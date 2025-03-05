<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LanguagesForm extends Form
{
    #[Rule([
        'languages' => 'required|array|min:1',
        'languages.*' => 'exists:languages,id',
    ])]
    public $languages = [];

    public function submit($Selectedlanguages){
        // Process submitted languages
        $this->languages = $Selectedlanguages;
        $validated = $this->validate();
        $user = Auth::user();
        foreach ($validated['languages'] as $language) {
            $user->languages()->syncWithoutDetaching($language);
        }

    }
}
