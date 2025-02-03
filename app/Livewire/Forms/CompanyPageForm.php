<?php

namespace App\Livewire\Forms;

use App\Models\PersonalDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyPageForm extends Form
{
    public $page_name;
    public $description;

    protected $rules = [
        'page_name' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:1000',
    ];

    public function submit()
    {
        $validator = $this->validate();

        // Save the form data to the database or perform other actions
        // Example:
        // PersonalDetail::create([
        //     'page_name' => $validator['page_name'],
        //     'professional_summary' => $validator['description'],
        //     'user_id' => Auth::user()->id,
        // ]);

        $this->reset();
        // dd($validator);
    }
}
