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
}

