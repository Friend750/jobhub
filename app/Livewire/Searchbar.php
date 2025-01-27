<?php

namespace App\Livewire;

use Livewire\Component;

class Searchbar extends Component
{
    public $query = ''; // Public variable to bind the search input

    public function search()
    {
        // Handle the search logic or redirect with the query
        session(['searchQuery' => $this->query]);

        // Optionally redirect to another page
        return redirect()->route('search');
    }
    public function render()
    {
        return view('livewire.searchbar');
    }
}
