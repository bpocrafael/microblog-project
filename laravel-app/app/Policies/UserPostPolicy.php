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
     * Check if the user can delete a post.
     */
    public function delete(User $user, UserPost $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Check if the user can view a post.
     */
    public function view(User $user, UserPost $post): bool
    {
        if ($user != null) {

            $isFollowing = ($user->isFollowing($post->user));
            $isOwner = false;
            if ($user != null && $post->user != null) {
                $isOwner = $user->id === $post->user->id;
            }

            return  $isFollowing || $isOwner;
        }

        return false;
    }
}
