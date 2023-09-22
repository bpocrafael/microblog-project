<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        // Get the authenticated user
        $user = $this->guard()->user();

        if (!$user->is_verified) {
            $this->guard()->logout();
            throw ValidationException::withMessages(['email' => 'Your account is not verified.']);
        }

        return $this->authenticated($request, $user)
            ?: redirect()->intended($this->redirectPath());
    }
}
