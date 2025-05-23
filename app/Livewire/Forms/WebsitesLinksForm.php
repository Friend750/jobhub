<?php

namespace App\Livewire\Forms;

use App\Livewire\EnhanceProfile;
use App\Models\Link;
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

    public function resetForm()
    {

        $this->websites = [
            ['website_name' => '', 'link' => '']
        ];
    }

    // updateWebsite
    public function getLink($website_name, $link)
    {

        $this->websites = [
            ['website_name' => $website_name, 'link' => $link]
        ];

    }

    public function submit()
    {
        $validated = $this->validate();

        // Get the authenticated user
        $user = auth()->user();

        foreach ($validated['websites'] as $websiteData) {
            // Create the link
            $link = Link::create([
                'website_name' => $websiteData['website_name'],
                'link' => $websiteData['link'],
            ]);

            // Attach the link to the authenticated user
            $user->links()->attach($link->id);
        }

        // Optionally, reset the form after submission
        // $this->reset();
    }

}
