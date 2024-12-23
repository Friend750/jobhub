<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $statistics = [];
    public $notifications = [];

    public function mount()
    {
        // Dummy data for statistics
        $this->statistics = [
            'lastPostViews' => 367,
            'postViews' => 15,
            'profileViews' => 9,
        ];

        // Dummy data for notifications
        $this->notifications = [
            [
                'user' => 'Ashwin Bose',
                'message' => 'is requesting access to Design File - Final Project.',
                'time' => '15h ago',
            ],
            [
                'user' => 'Patrick',
                'message' => 'added a comment on Design Assets - Smart Tags file: "Looks perfect, send it for technical review tomorrow!"',
                'time' => '12h ago',
            ],
            [
                'user' => 'Samantha',
                'message' => 'has shared a file with you.',
                'time' => '10h ago',
            ],
            [
                'user' => 'Steve and 8 others',
                'message' => 'added comments on Design Assets - Smart Tags file.',
                'time' => '8h ago',
            ],
        ];
    }
    public function render()
    {
        return view('livewire.notifications');
    }
}
