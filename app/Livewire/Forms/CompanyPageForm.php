<?php

namespace App\Livewire\Forms;

use App\Models\Link;
use App\Models\PersonalDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyPageForm extends Form
{
    #[Rule([
        'page_name' => 'required|min:3|max:255',
        'description' => 'required|min:10|max:1000',
        'city' => 'required|min:3|max:255',
        'phone' => 'required|min:9|max:15',
        'website' => 'required|min:3|max:255',
        'link' => 'required|url',
        'major' => 'required',
    ])]

    public $page_name;
    public $description;
    public $city;
    public $phone;
    public $website;
    public $link;
    public $major;

    // Method to fetch old data
    public function OldData()
    {
        // Fetch the personal details of the authenticated user
        $personalDetail = PersonalDetail::where('user_id', Auth::user()->id)->first();

        // If a record exists, populate the form fields
        if ($personalDetail) {
            $this->page_name = $personalDetail->page_name;
            $this->description = $personalDetail->professional_summary;
            $this->city = $personalDetail->city;
            $this->phone = $personalDetail->phone;
            $this->website = $personalDetail->website_name;
            $this->link = $personalDetail->link;
            $this->major = $personalDetail->specialist;
        }
    }
    public function submit()
    {
        $validator = $this->validate();
        $user_id = Auth::user()->id;

        PersonalDetail::updateOrCreate(
            [
                'user_id' => $user_id, // Condition to find the record
            ],
            [
                'page_name' => $validator['page_name'],
                'professional_summary' => $validator['description'],
                'city' => $validator['city'],
                'phone' => $validator['phone'],
                'website_name' => $validator['website'],
                'link' => $validator['link'],
                'specialist' => $validator['major'],
                'user_id' => $user_id,
            ]
        );

        $this->reset();
        // with flash message

        redirect()->route('user-profile')->with('message','Updated successfully');
    }
}
