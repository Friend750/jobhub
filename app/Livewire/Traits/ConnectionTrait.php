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
        $receiver->notify(new Request(Auth::user(), $receiver,PersonalDetail::where('user_id', Auth::id())->first()));
    }

    public function getFollowStatus($userId)
    {
        $connection = Connection::where('follower_id', $userId)
            ->where('following_id', Auth::id())
            ->first();

        return [
            'isFollowing' => $connection && $connection->is_accepted == 1,
            'isRequested' => $connection && $connection->is_accepted == 0,
        ];
    }

    public function startConversation($userId)
    {
        $conversation = Conversation::where(function ($query) use ($userId) {
            $query->where('first_user', Auth::id())
                  ->where('second_user', $userId);
        })
        ->orWhere(function ($query) use ($userId) {
            $query->where('first_user', $userId)
                  ->where('second_user', Auth::id());
        })
        ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'first_user'  => Auth::id(),
                'second_user' => $userId,
            ]);
        }

        return redirect()->route('chat', ['conversationId' => $conversation->id]);
    }

    public function showUser($id)
    {
        return redirect()->route('user-profile', $id);
    }
}
