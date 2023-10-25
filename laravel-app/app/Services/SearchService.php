<?php

namespace App\Services;

use App\Interfaces\SearchServiceInterface;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService implements SearchServiceInterface
{
    /**
     * To search the User and Posts of followed users for the mathching keyword.
     */
    public function searchUser(string $query): LengthAwarePaginator
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $users = User::whereHas('information', function ($queryBuilder) use ($query) {
            $queryBuilder->where('username', 'like', '%' . $query . '%')
                ->orWhere('first_name', 'like', '%' . $query . '%')
                ->orWhere('middle_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%');
        })
            ->where('is_verified', 1)
            ->get()
            ->collect()
            ->all();

        $postsQuery = UserPost::whereIn('user_id', $authUser->following->pluck('id')->push($authUser->id))
            ->where('content', 'regexp', '\b' . $query . '\b')
            ->get()
            ->collect()
            ->all();

        $combinedResults = array_merge($users, $postsQuery);

        $perPage = 4;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        $slicedResults = array_slice($combinedResults, $offset, $perPage);

        return new LengthAwarePaginator($slicedResults, count($combinedResults), $perPage, $page);
    }
}
