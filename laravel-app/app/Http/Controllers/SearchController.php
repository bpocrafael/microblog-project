<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\SearchRequest;
use App\Models\User;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected SearchService $searchService;

    /**
     * Make an instance of SearchController.
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * To search for user and posts globally.
     */
    public function search(SearchRequest $request): View
    {
        $authUser = auth()->user();
        $query = $request->input('query');

        $searchResults = $this->searchService->searchUser($query);

        return view('search.results', compact('authUser', 'searchResults', 'query'));
    }

    /**
     * To search for followers/following users.
     */
    public function searchFollowers(SearchRequest $request, User $user): View
    {
        $authUser = auth()->user();
        $query = $request->input('query');

        $query = $request->input('query');

        $searchResults = $this->searchService->searchFollowers($query, $user);

        return view('search.results_followers', compact('authUser', 'user', 'searchResults', 'query'));
    }
}
