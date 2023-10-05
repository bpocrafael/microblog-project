<?php

namespace App\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
	/**
	 * @param User $user
	 * @param array<mixed, mixed> $data
	 */
	public function updateProfile(User $user, array $data): Void;
}
