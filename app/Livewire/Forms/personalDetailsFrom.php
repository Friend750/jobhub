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

    protected function rules()
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => [
                'required',
                'numeric',
                'digits:9',
                function ($attribute, $value, $fail) {
                    $validPrefixes = ['77', '78', '71', '73', '70'];
                    $prefix = substr($value, 0, 2);

                    if (!in_array($prefix, $validPrefixes)) {
                        $fail('يجب أن يبدأ رقم الهاتف بـ 77، 78، 71، 73 أو 70');
                    }
                },
            ],
            'city' => 'required|string|max:255',
            'description' => 'required|string|min:50|max:500',
        ];
    }
    public $phone = "";


    #[Rule('required|string|max:255')]
    public $city = "";

    #[Rule('required|string|min:50|max:500')]
    public $description;


    public function oldData(){
        $oldData = Auth::user()->personal_details;
        // dd($oldData);
        $this->firstName = $oldData->first_name ?? "";
        $this->lastName = $oldData->last_name ?? "";
        $this->jobTitle = $oldData->specialist ?? "";
        $this->email = Auth::user()->email;
        $this->phone = $oldData->phone ?? "";
        $this->city = $oldData->city ?? "";
        $this->description = $oldData->professional_summary ?? "";
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
        // $this->reset();
    }
}
