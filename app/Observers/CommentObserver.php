<?php

namespace App\Observers;

use App\Jobs\ProcessComment;
use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        ProcessComment::dispatch($comment);
    }
} 