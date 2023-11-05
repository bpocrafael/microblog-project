<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserVerificationService;
use App\Services\LoginService;
use Illuminate\View\View;

class LoginController extends Controller
{
    protected UserVerificationService $userVerificationService;
    protected LoginService $loginService;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        UserVerificationService $userVerificationService,
        LoginService $loginService,
    ) {
        $this->userVerificationService = $userVerificationService;
        $this->loginService = $loginService;
    }


    /**
     * Show the welcome page.
     */
    public function index(): View
    {
        return view('welcome');
    }

    /**
     * Show login form page.
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Handle authentication based on the provided request.
     */
    public function authenticate(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {

        $isAuthenticated = $this->loginService->isAuthenticated($request);

        if (!$isAuthenticated) {
            return redirect()->route('login');
        }

        /** @var \Illuminate\Contracts\Auth\Guard */
        $auth = auth();
        $user = $auth->user();

        if ($user === null || !$this->userVerificationService->isUserVerified($user)) {

            return redirect()->route('resend');
        }

        return redirect()->route('home')->with('success', 'Welcome ' . $user->username . ' to Microblog!');
    }
}
