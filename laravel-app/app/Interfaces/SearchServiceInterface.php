<?php

namespace App\Interfaces;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface SearchServiceInterface
{
    public function searchUser(string $query): Builder;
}
