<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConversationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user, Conversation $conversation)
    {
        // User can view only if they are a participant (first_user or second_user)
        return $user->id === $conversation->first_user || $user->id === $conversation->second_user;
    }

    /**
     * Determine if the user can send messages in the conversation.
     */
    public function sendMessage(User $user, Conversation $conversation)
    {
        // User can send messages only if they are a participant
        return $this->view($user, $conversation);
    }
}
