<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface SearchServiceInterface
{
    public function searchUser(string $query): Collection;
}
