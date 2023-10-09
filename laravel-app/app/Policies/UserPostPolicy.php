<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPost;

class UserPostPolicy
{
    /**
     * Determine whether the user can update the post.
     */
    public function edit(User $user, UserPost $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, UserPost $post): bool
    {
        return $user->id === $post->user_id;
    }
}
