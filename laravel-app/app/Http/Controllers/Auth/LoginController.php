<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\UserVerificationService;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $userVerificationService;

    public function __construct(UserVerificationService $userVerificationService)
    {
        $this->middleware('guest')->except('logout');
        $this->userVerificationService = $userVerificationService;
    }

    protected function authenticated(Request $request, $user)
    {
        // Use the customized UserVerificationService to check if the user is verified
        if (!$this->userVerificationService->isUserVerified($user)) {
            auth()->logout(); // Log the user out if not verified
            return redirect()->route('login')
                ->withErrors(['email' => 'Your account is not verified.']);
        }

        return redirect()->intended($this->redirectPath());
    }
}
