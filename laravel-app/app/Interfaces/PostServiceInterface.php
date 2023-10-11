<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
    /**
     * @param array<mixed, mixed> $validatedData
     */
    public function createPost(User $user, array $validatedData): UserPost;

    /**
     * @param array<string, mixed> $validatedData
     */
    public function updatePost(UserPost $post, array $validatedData): bool;

    public function sharePost(UserPost $post): UserPost;
}
