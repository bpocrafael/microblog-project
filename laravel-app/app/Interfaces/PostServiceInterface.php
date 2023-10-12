<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
    /**
     * @param  array<string> $validatedData
     */
    public function createPost(User $user, array $validatedData): UserPost;
}
