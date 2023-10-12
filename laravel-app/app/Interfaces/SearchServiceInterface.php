<?php

namespace App\Interfaces;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface SearchServiceInterface
{
    /**
     * Search user table for the keywords.
     */
    public function searchUser(string $query): Builder;
}
