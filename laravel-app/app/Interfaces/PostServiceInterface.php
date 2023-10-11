<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
    /**
     * To create a new post of the user.
     */
    public function createPost(User $user, array $validatedData): UserPost; // @phpstan-ignore-line

    /**
     * To update an existing post of the user.
     */
    public function updatePost(UserPost $post, array $validatedData): bool; // @phpstan-ignore-line

    /**
     * To reference an exsiting post in a new post.
     */
    public function sharePost(UserPost $post): UserPost;
}
