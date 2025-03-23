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
    public $paginateVarPeople = 5;
    public $paginateVarCompanies = 5;
    public $hasMorePeople = false;
    public $hasMoreCompanies = false;
    public $people;
    public $companies;
    public $query;



    public function mount()
    {

        $this->query = session('searchQuery', '');
        $this->loadPeople();
        $this->loadCompany();


    }


    public function loadMorePeople()
    {
        $this->paginateVarPeople += 5; // Increase the limit
        $this->loadPeople(); // Reload the data
    }
    public function loadMoreCompanies()
    {
        $this->paginateVarCompanies += 5; // Increase the limit
        $this->loadCompany(); // Reload the data
    }

    public function loadPeople()
    {
        $results = User::where('user_name', 'like', '%' . $this->query . '%')
            ->where('user_name', '!=', auth()->user()->user_name)
            ->where('type', 'user')
            ->take($this->paginateVarPeople + 1) // Fetch one extra record to check for more pages
            ->get()
            ->values();

        $this->hasMorePeople = $results->count() > $this->paginateVarPeople; // Check if there are more records
        $this->people = $results->take($this->paginateVarPeople); // Only take the current page's data
    }

    public function loadCompany()
    {
        $results = User::where('user_name', 'like', '%' . $this->query . '%')
            ->where('user_name', '!=', auth()->user()->user_name)
            ->where('type', 'company')
            ->take($this->paginateVarCompanies + 1) // Fetch one extra record to check for more pages
            ->get()
            ->values();

        $this->hasMoreCompanies = $results->count() > $this->paginateVarCompanies; // Check if there are more records
        $this->companies = $results->take($this->paginateVarCompanies); // Only take the current page's data
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

public function showUser($id){
    return redirect()->route('user-profile', $id);
}
    public function render()
    {
        return view('livewire.search');
    }
}
