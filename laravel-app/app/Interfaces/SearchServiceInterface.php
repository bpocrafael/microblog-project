<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface SearchServiceInterface
{
    /**
     * Search user table for the keywords.
     */
    public function searchUser(string $query): LengthAwarePaginator;
}
