<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Chat extends Component
{
    #[Title('Chat')]
    public $chats; // قائمة الدردشات
    public $selectedChat = null; // المحادثة المختارة
    public $messages = []; // الرسائل

    public function mount()
    {
        // تحميل قائمة الدردشات
        $this->chats = [
            ['id' => 1, 'name' => 'Darlene Black', 'last_message' => 'Hey, how is your project?', 'profile' => '100'],
            ['id' => 2, 'name' => 'Theresa Steward', 'last_message' => 'Hi, Dmitry! I have a work for you.', 'profile' => '100'],
            ['id' => 3, 'name' => 'Brandon Wilson', 'last_message' => 'I am Russian and I am learning English.', 'profile' => '100'],
            ['id' => 4, 'name' => 'Kyle Fisher', 'last_message' => 'So, it\'s up to you!', 'profile' => '100.png'],
        ];
    }

    public function selectChat($chatId)
    {
        $this->selectedChat = collect($this->chats)->firstWhere('id', $chatId);
        $this->messages = [
            ['text' => 'Hi, Kyle. How are you doing?', 'from_me' => true, 'time' => '4:20 PM'],
            ['text' => 'Nope, they kicked me out of the office!', 'from_me' => false, 'time' => '4:29 PM'],
            ['text' => 'Wow! I can invite you in my new project.', 'from_me' => true, 'time' => '4:30 PM'],
            ['text' => 'Hi, Kyle. How are you doing?', 'from_me' => true, 'time' => '4:20 PM'],
            ['text' => 'Nope, they kicked me out of the office!', 'from_me' => false, 'time' => '4:29 PM'],
            ['text' => 'Wow! I can invite you in my new project.', 'from_me' => true, 'time' => '4:30 PM'],
            ['text' => 'Hi, Kyle. How are you doing?', 'from_me' => true, 'time' => '4:20 PM'],
            ['text' => 'Nope, they kicked me out of the office!', 'from_me' => false, 'time' => '4:29 PM'],
            ['text' => 'Wow! I can invite you in my new project.', 'from_me' => true, 'time' => '4:30 PM'],
            ['text' => 'Hi, Kyle. How are you doing?', 'from_me' => true, 'time' => '4:20 PM'],
            ['text' => 'Nope, they kicked me out of the office!', 'from_me' => false, 'time' => '4:29 PM'],
            ['text' => 'Wow! I can invite you in my new project.', 'from_me' => true, 'time' => '4:30 PM'],
            ['text' => 'Hi, Kyle. How are you doing?', 'from_me' => true, 'time' => '4:20 PM'],
            ['text' => 'Nope, they kicked me out of the office!', 'from_me' => false, 'time' => '4:29 PM'],
            ['text' => 'Wow! I can invite you in my new project.', 'from_me' => true, 'time' => '4:30 PM'],
        ];
    }

    public function render()
    {
        return view('livewire.chat');
    }
}

