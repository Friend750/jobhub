<?php

namespace App\Traits;

trait FeedScopes
{
    public function scopeForUserFeed($query, $userId)
    {
        return $query->forFeed()
            ->where(function ($q) use ($userId) {
                $q->where('user_id', $userId) // Always include user's own posts
                    ->orWhere('target', 'to_any_one'); // Plus public posts
            });
    }

    public function scopeForFollowedUsers($query, $followedIds, $userId)
    {
        return $query->forUserFeed($userId)
            ->where(function ($q) use ($followedIds, $userId) {
                $q->whereIn('user_id', $followedIds)
                    ->orWhere('user_id', $userId); // Explicitly include user's posts
            });
    }

    public function scopeForSameInterestUsers($query, $sameInterestUserIds, $userId)
    {
        return $query->forUserFeed($userId)
            ->where(function ($q) use ($sameInterestUserIds, $userId) {
                $q->whereIn('user_id', $sameInterestUserIds)
                    ->where('target', 'to_any_one') // Only public posts from same-interest users
                    ->orWhere('user_id', $userId); // Plus user's own posts
            });
    }
}
