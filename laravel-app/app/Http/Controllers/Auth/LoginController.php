<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserVerificationService;
use App\Services\LoginService;

class LoginController extends Controller
{
    protected $userVerificationService;
    protected $loginService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserVerificationService $userVerificationService, LoginService $loginService)
    {
        $this->userVerificationService = $userVerificationService;
        $this->loginService = $loginService;
    }

    /**
     * Display login form
     */
    public function index()
    {
        return view('auth.login');
    }
    
    /**
     * Authenticate login form
     */
    public function authenticate(LoginRequest $request)
    {
        $isAuthenticated = $this->loginService->isAuthenticated($request);

        if ($isAuthenticated) {
            $user = auth()->user();
            $isVerified = $this->userVerificationService->isUserVerified($user);

            if ($isVerified && $isAuthenticated) {
                return redirect()->route('home');
            }
        }

        return redirect()->route('login');
    }
}
