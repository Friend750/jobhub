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


    public function submit()
    {
        $validator = $this->validate();

        PersonalDetail::create([
            'page_name' => $validator['page_name'],
            'professional_summary' => $validator['description'],
            'city' => $validator['city'],
            'phone' => $validator['phone'],
            'website_name' => $validator['website'],
            'link' => $validator['link'],
            'specialist' => $validator['major'],
            'user_id' => Auth::user()->id,
        ]);


        $this->reset();
        redirect()->route('user-profile');
    }
}
