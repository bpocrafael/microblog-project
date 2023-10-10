<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
    /**
     * @param User $user
     * @param array<mixed, mixed> $validatedData
     */
    public function createPost(User $user, array $validatedData): UserPost;

    /**
     * To update an existing post.
     *
     * @param UserPost $post
     * @param array<string, mixed> $validatedData
     * @return bool
     */
    public function updatePost(UserPost $post, array $validatedData): bool;

    public function sharePost(UserPost $post): UserPost;
}
