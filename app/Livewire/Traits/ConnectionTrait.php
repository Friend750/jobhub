<?php

namespace App\Livewire\Traits;

use App\Models\Connection;
use App\Models\User;
use App\Models\Conversation;
use App\Models\PersonalDetail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Request;

trait ConnectionTrait
{
    public function unFollow($connectionId)
    {
       $connection = Connection::where('following_id', Auth::id())
    ->where('follower_id', $connectionId)
    ->first();

if ($connection) {
    $connection->delete();
    $this->dispatch('connectionUpdated');
}

    }

private function createFollow(int $followerId, int $followingId): ?Connection
{
    if ($followerId === $followingId) {
        return null; // لا يمكن متابعة نفسه
    }

    $existing = Connection::withTrashed()
        ->where('follower_id', $followerId)
        ->where('following_id', $followingId)
        ->first();

    if ($existing) {
        if ($existing->trashed()) {
            $existing->restore();
        }
        return $existing;
    }

    return Connection::create([
        'follower_id' => $followerId,
        'following_id' => $followingId,
        'is_accepted' => 0
    ]);
}

private function notifyFollow(Connection $connection)
{
    $receiver = User::with('personal_details')->find($connection->follower_id);
    if ($receiver) {
        $receiver->notify(new Request(
            Auth::user(),
            $receiver,
            Auth::user()->personal_details
        ));
    }
}

public function follow(int $connectionId)
{
    $connection = $this->createFollow($connectionId, Auth::id());

    if (!$connection) {
        session()->flash('error', 'Invalid follow request.');
        return;
    }

    if (!$connection->wasRecentlyCreated) {
        session()->flash('message', 'Follow request already exists or restored.');
    } else {
        $this->notifyFollow($connection);
        session()->flash('message', 'Follow request sent.');
    }
}




    public function getFollowStatus($userId)
    {
       $status = Connection::where('follower_id', $userId)
    ->where('following_id', Auth::id())
    ->value('is_accepted'); // يرجع قيمة العمود مباشرة أو null

    return [
    'isFollowing' => $status === 1,
    'isRequested' => $status === 0,
           ];
    }

   public function startConversation(int $userId)
{
    $conversation = Conversation::betweenUsers(Auth::id(), $userId);

    return redirect()->route('chat', ['conversationId' => $conversation->id]);
}

public function showUser($id)
{
    $user = User::find($id);
    if (!$user) {
        abort(404, 'User not found');
    }

    return redirect()->route('user-profile', $user->id);
}

}
