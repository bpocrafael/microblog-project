<?php

namespace App\Interfaces;

use App\Http\Requests\LoginRequest;

interface LoginServiceInterface
{
	public function isAuthenticated(LoginRequest $loginRequest) : bool;
}
