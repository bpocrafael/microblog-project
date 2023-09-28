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
     *
     * @return void
     * @param UserVerificationService $userVerificationService
     * @param LoginService $loginService
     */
    public function __construct(
        UserVerificationService $userVerificationService,
        LoginService $loginService,
    ) {
        $this->userVerificationService = $userVerificationService;
        $this->loginService = $loginService;
    }


    /**
     * Show login form page.
     *
     * @return View
     */
    public function index(): View
    {
        /** @var View */
        return view('auth.login');
    }

    /**
     * Handle authentication based on the provided request.
     *
     * @param  LoginRequest $request The incoming request containing user credentials.
     * @return \Illuminate\Http\RedirectResponse Redirect response based on authentication success or failure.
     */
    public function authenticate(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {

        $isAuthenticated = $this->loginService->isAuthenticated($request);

        if (!$isAuthenticated) {
            /** @var \Illuminate\Routing\Redirector $redirector */
            $redirector = redirect();

            return $redirector->route('login');
        }

        /** @var \Illuminate\Contracts\Auth\Guard */
        $auth = auth();
        $user = $auth->user();

        $isVerified = $this->userVerificationService
            ->isUserVerified($user);

        if (!$isVerified) {
            /** @var \Illuminate\Routing\Redirector $redirector */
            $redirector = redirect();

            return $redirector->route('login');
        }

        /** @var \Illuminate\Routing\Redirector $redirector */
        $redirector = redirect();

        return $redirector->route('home');
    }
}
