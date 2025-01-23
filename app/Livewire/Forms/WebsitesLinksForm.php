<?php

namespace App\Livewire\Forms;

use App\Livewire\EnhanceProfile;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class WebsitesLinksForm extends Form
{
    #[Rule([
        'websites.*.website_name' => 'required|string|max:255',
        'websites.*.link' => 'required|url',
    ])]
    public $websites = [
        ['website_name' => '', 'link' => '']
    ];

    protected $messages = [
        'websites.*.website_name.required' => 'The website :position name is required.',
        'websites.*.link.required' => 'The website :position link is required.',
        'websites.*.link.url' => 'The website link must be a valid URL.',
    ];

    public function addRow()
    {
        $this->websites[] = ['website_name' => '', 'link' => ''];
    }

    public function removeRow($index)
    {
        unset($this->websites[$index]);
        $this->websites = array_values($this->websites); // Reindex the array
    }

    public function resetForm(){
        dump('resetForm');
        $this->websites = [
            ['website_name' => '', 'link' => '']
        ];
    }

    public function submit()
    {
        $this->validate();
        // $this->reset();
    }
}
