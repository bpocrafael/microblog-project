<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
    /**
     * To create a new post of the user.
     * @param  array<string> $validatedData
     */
    public function createPost(User $user, array $validatedData): UserPost;

    /**
     * To update an existing post of the user.
     * @param  array<string> $validatedData
     */
    public function updatePost(UserPost $post, array $validatedData): bool;

    /**
     * To reference an exsiting post in a new post.
     */
    public function sharePost(UserPost $post): UserPost;
}
