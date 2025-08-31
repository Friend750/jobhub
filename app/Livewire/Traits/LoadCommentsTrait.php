<?php

namespace App\Livewire\Traits;

trait LoadCommentsTrait
{
    public $commentsToShow = 5; // الافتراضي

    public function loadMoreComments($count = 5)
    {
        $this->commentsToShow += $count;
    }

    public function resetCommentsToShow($count = 5)
    {
        $this->commentsToShow = $count;
    }
}
