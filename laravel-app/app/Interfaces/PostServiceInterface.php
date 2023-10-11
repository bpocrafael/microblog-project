<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
    /**
     * To create a new post.
     */
    public function createPost(User $user, array $validatedData): UserPost;

    /**
     * To update an existing post.
     */
    public function updatePost(UserPost $post, array $validatedData): bool;

    /**
     * Reference an existing post in a new post.
     */
    public function sharePost(UserPost $post): UserPost;
}
