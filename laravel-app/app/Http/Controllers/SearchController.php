<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function search(SearchRequest $request): View
    {
        $query = $request->input('query');

        $results = $this->searchService->searchUser($query)->paginate(4);

        return view('search.results', ['results' => $results, 'query' => $query]);
    }
}
