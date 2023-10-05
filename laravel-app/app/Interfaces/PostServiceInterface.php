<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface PostServiceInterface
{
	public function createPost(User $user, array $validatedData): UserPost;
}
