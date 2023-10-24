<?php

namespace App\Policies;

use App\Models\PostComment;
use App\Models\User;

class PostCommentPolicy
{
    /**
     * Determines whether the user can delete his/her own comment.
     */
    public function delete(User $user, PostComment $comments): bool
    {
        return $user->id === $comments->user_id;
    }
    /**
     * Determines whether the user can edit his/her own comment.
     */
    public function edit(User $user, PostComment $comments): bool
    {
        return $user->id === $comments->user_id;
    }
}
