<?php

namespace App\Livewire;

use App\Models\Connection;
use App\Models\User;
use App\Notifications\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class CompanyList extends Component
{
    #[Title('Companies')]
    public $companies;

    public function mount()
{

    $user = auth()->user();
    $this->companies = $user->companies()
        ->get()
        ->map(function ($company) {
            return [
                'id' => $company->id,
                'user_name' => $company->user_name,
                'user_image' => $company->user_image ?? null,
                'is_accepted' => $company->pivot->is_accepted // Include if needed
            ];
        })->toArray();
}

public function unFollow($connectionId)
{
        // البحث عن السجل المرتبط بالمستخدم الحالي وحذفه باستخدام Soft Delete
        Connection::where('follower_id', $connectionId)
          ->where('following_id', Auth::id())
          ->delete();


    $this->dispatch('connectionUpdated');
}


public function follow($connectionId)
{

        $receiver = User::find($connectionId);

        Connection::create([
            'follower_id' => $connectionId,
            'following_id' => Auth::id(),
            'is_accepted' => 0
        ]);
        $receiver->notify(new Request( auth()->user(),$receiver));

}
public function getFollowStatus($userId)
{
    $connection = Connection::where('follower_id', $userId)
    ->where('following_id', Auth::id())
    ->first();
    return [
        'isFollowing' => $connection && $connection->is_accepted == 1, // Active following
        'isRequested' => $connection && $connection->is_accepted == 0, // Pending request
    ];
}


public function showUser($id){
    return redirect()->route('user-profile', $id);
}
    public function render()
    {
        return view('livewire.company-list');
    }
}
