<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResendEmailRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected RegistrationService $registrationService;

    /**
     * Create a new controller instance.
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
        $this->middleware('guest');
    }

    /**
     * Show login form page.
     */
    public function showRegistrationForm(): view
    {
        return view('auth.register');
    }

    /**
     * Show resend page
     */
    public function resendPage(): view
    {
        return view('auth.resend');
    }

    /**
     * Create a new user instance after a valid registration.
     */
    public function register(CreateUserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->registrationService->registerUser($validatedData);

        return redirect()->route('login')->with('success', 'Registration complete. Please check email');
    }

    /**
     * Verifies email after registration
     */
    public function verifyEmail(string $verificationCode): RedirectResponse
    {
        $result = $this->registrationService->verifyEmail($verificationCode);

        if (!$result) {
            return redirect()->route('resend')->with('error', 'Verification link expired or email already verified');
        }

        return redirect()->route('login')->with('success', 'Email successfully verified');
    }

    /**
     * Resends email for verification
     */
    public function resendEmail(ResendEmailRequest $request): RedirectResponse
    {
        $email = $request->input('email-resend');

        $result = $this->registrationService->resendEmail($email);

        if (!$result) {
            return redirect()->route('resend')->with('error', 'Email doesn\'t exist in the database or is already verified');
        }
        return redirect()->route('login')->with('success', 'Email verification link has been resent. Check your email.');
    }
}
