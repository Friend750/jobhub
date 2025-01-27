<?php

namespace App\Livewire;

use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Search extends Component
{
    #[Title('Search')]
    public $activeTab = 'people'; // العنصر النشط افتراضيًا

    public function switchTab($tab)
    {
        $this->activeTab = $tab; // تحديث العنصر النشط
        if($tab == 'people')
        {
            $this->people = User::where('user_name', 'like', '%' . $this->query . '%')
            ->where('user_name', '!=', auth()->user()->user_name) // Exclude the current user
            ->where('type', 'user') // Filter by user type
            ->get();
        }
        else if($tab == 'company')
        {
            $this->people = User::where('user_name', 'like', '%' . $this->query . '%')
            ->where('user_name', '!=', auth()->user()->user_name) // Exclude the current user
            ->where('type', 'company') // Filter by user type
            ->get();
        }
    }
    public $people;
    public $query;

    public function mount()
    {
  
        $this->query = session('searchQuery', '');

        $this->switchTab('people');
    
    }

  

    public function unFollow($connectionId)
    {
            // البحث عن السجل المرتبط بالمستخدم الحالي وحذفه باستخدام Soft Delete
                 DB::table('connections')
                ->where('follower_id',$connectionId) // المستخدم الحالي هو المتابع
                ->where('following_id',  Auth::id()) // ID الذي تم تمريره
                ->delete(); // Soft Delete
    
    
        $this->dispatch('connectionUpdated');
    }

    public function getUserById($receiverId)
    {
    return User::find($receiverId); 
    }
    
    
    public function follow($connectionId)
    {
            
            $receiver = $this->getUserById($connectionId);
            
            DB::table('connections')->insert([
                'follower_id' => $connectionId,
                'following_id' => Auth::id(),
                'is_accepted' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $receiver->notify(new Request( auth()->user(),$receiver));
            
    }


public function startConversation($userId)
{
    // التحقق إذا كانت المحادثة موجودة
    $conversation = DB::table('conversations')
        ->where(function ($query) use ($userId) {
            $query->where('first_user', auth()->id())
                  ->where('second_user', $userId);
        })
        ->orWhere(function ($query) use ($userId) {
            $query->where('first_user', $userId)
                  ->where('second_user', auth()->id());
        })
        ->first();

    if (!$conversation) {
        // إذا لم تكن المحادثة موجودة، قم بإنشائها
        $conversationId = DB::table('conversations')->insertGetId([
            'first_user' => auth()->id(),
            'second_user' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $conversation = DB::table('conversations')->find($conversationId);
    }

    // التوجيه إلى شاشة المحادثة
        return redirect()->route('chat', ['conversationId' => $conversation->id]);
}
    
    public function render()
    {
        return view('livewire.search');
    }
}
