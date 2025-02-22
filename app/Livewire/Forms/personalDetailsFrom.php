<?php

namespace App\Livewire\Forms;

use App\Livewire\EnhanceProfile;
use App\Models\PersonalDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class personalDetailsFrom extends Form
{
    #[Rule('required|string|max:255')]
    public $firstName = "";

    #[Rule('required|string|max:255')]
    public $lastName = "";

    #[Rule('required|string|max:255')]
    public $jobTitle = "";

    #[Rule('required|email|max:255')]
    public $email = "";

    #[Rule('required|numeric|digits_between:10,15')]
    public $phone = "";

    #[Rule('required|string|max:255')]
    public $city = "";

    #[Rule('required|string|min:50|max:500')]
    public $description;


    public function oldData(){
        $oldData = Auth::user()->personal_details;
        // dd($oldData);
        $this->firstName = $oldData->first_name ?? "null";
        $this->lastName = $oldData->last_name ?? "null";
        $this->jobTitle = $oldData->specialist ?? "null";
        $this->email = Auth::user()->email;
        $this->phone = $oldData->phone ?? "null";
        $this->city = $oldData->city ?? "null";
        $this->description = $oldData->professional_summary ?? "null";
    }

    public function submit()
    {
        $validated = $this->validate();
        // create or update
        PersonalDetail::updateOrCreate(
            ['user_id' => Auth::id()], // Search by user_id only
            [
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'specialist' => $validated['jobTitle'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'professional_summary' => $validated['description'],
            ]
        );
        // dd($validated);
        $this->reset();
    }
}
