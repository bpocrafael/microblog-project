<?php

namespace App\Services;

use App\Interfaces\SearchServiceInterface;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;

class SearchService implements SearchServiceInterface
{
    /**
     * To search the User table using the Eloquent of matching results.
     * @return Collection<User>
     */
    public function searchUser(String $query): Builder
    {
        return User::where('username', 'like', '%' . $query . '%');
    }
}
