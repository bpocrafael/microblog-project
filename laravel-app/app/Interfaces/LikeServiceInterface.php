<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\UserPost;

interface LikeServiceInterface
{
	public function like(User $user, UserPost $post): void;
}

