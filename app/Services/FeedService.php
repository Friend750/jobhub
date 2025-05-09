<?php

namespace App\Services;

use App\Models\JobPost;
use App\Models\Post;
use App\Models\Connection;
use Illuminate\Support\Facades\Auth;

class FeedService
{
    public function getFeedForUser($user)
    {
        $followedIds = Connection::where('following_id', $user->id)
            ->where('is_accepted', 1)
            ->pluck('follower_id');

        if ($followedIds->isNotEmpty()) {
            $jobPosts = JobPost::forFollowedUsers($followedIds, $user->id);
            $normalPosts = Post::forFollowedUsers($followedIds, $user->id);

            if (!$this->hasPosts($jobPosts, $normalPosts)) {
                $fallbackIds = Connection::where('following_id', $user->id)
                    ->where('is_accepted', 0)
                    ->pluck('follower_id');

                $jobPosts = JobPost::forFollowedUsers($fallbackIds, $user->id)
                    ->where('target', 'to_any_one');
                $normalPosts = Post::forFollowedUsers($fallbackIds, $user->id)
                    ->where('target', 'to_any_one');
            }
        } else {
            $sameInterestUserIds = $user->sameInterests()->pluck('id');
            $jobPosts = JobPost::forSameInterestUsers($sameInterestUserIds, $user->id);
            $normalPosts = Post::forSameInterestUsers($sameInterestUserIds, $user->id);
        }

        $jobPosts = $jobPosts->with(['comments', 'user.personal_details'])->get();
        $normalPosts = $normalPosts->with(['comments', 'user.personal_details'])->get();

        return $jobPosts->merge($normalPosts)->sortByDesc('created_at')->values();
    }

    protected function hasPosts($jobPostsQuery, $normalPostsQuery): bool
    {
        return $jobPostsQuery->exists() || $normalPostsQuery->exists();
    }
}

?>
