<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SearchService
{
	/**
	 * To search the User table using the Eloquent of matching results.
	 * @return Collection<User>
	 */
	public function searchUser(String $query): Collection
	{
		return User::where('username', 'like', '%' . $query . '%')->get();
	}
}
