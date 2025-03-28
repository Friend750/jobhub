<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class FollowersScreen extends Component
{
    #[Title('Followers')]
    public $followers;
    public function mount()
{
    $user = User::find(auth()->user()->id);

    $this->followers = $user->acceptedFollowers()
    ->with('experiences')
    ->get()
    ->map(function ($follower) {
        return [
            'id' => $follower->id,
            'user_name' => $follower->user_name,
            'position' => optional($follower->experiences->sortByDesc('created_at')->first())->job_title ?? 'No Position',
            'user_image' => $follower->user_image ?? null,
        ];
    })->toArray();

}

public function deleteConnection($connectionId)
    {
        // البحث عن السجل المرتبط بالمستخدم الحالي وحذفه باستخدام Soft Delete
        $deleted = DB::table('connections')
            ->where('follower_id',Auth::id()) // المستخدم الحالي هو المتابع
            ->where('following_id', $connectionId ) // ID الذي تم تمريره
            ->delete(); // Soft Delete

        if ($deleted) {
            session()->flash('message', 'Connection deleted successfully!');
        } else {
            session()->flash('error', 'Connection not found or already deleted!');
        }

    $this->dispatch('connectionUpdated');
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
        return view('livewire.followers-screen');
    }
}
