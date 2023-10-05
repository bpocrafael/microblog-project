<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
	public function updateProfile(User $user, array $data): Void;
}
