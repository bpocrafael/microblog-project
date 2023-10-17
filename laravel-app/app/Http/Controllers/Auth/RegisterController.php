<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ResendEmailRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
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

        $user =  User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'username' => $validatedData['username'],
            'email_verification_code' => Str::random(40),
        ]);

        $user->information()->create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
        ]);

        /** @var User $user */
        Mail::to($validatedData['email'])->send(new EmailVerificationMail($user));
        return redirect()->route('login')->with('success', 'Registration complete. Please check email');
    }

    /**
     * Verifies email after registration
     */
    public function verifyEmail(string $verificationCode): RedirectResponse
    {
        $user = User::where('email_verification_code', $verificationCode)->first();

        if (!$user) {
            return redirect()->route('resend')->with('error', 'Verification link expired. Resend another one.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('resend')->with('error', 'Email already verified');
        }

        $user->update([
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('login')->with('success', 'Email successfully verified');
    }

    /**
     * Resends email for verification
     */
    public function resendEmail(ResendEmailRequest $request): RedirectResponse
    {
        $email = $request->input('email-resend');
        $user = User::where('email', $email)->first();

        /** @var User $user */
        if ($user == null) {
            return redirect()->route('resend')->with('error', 'Email doesn\'t exist in the database.');
        }
        if ($user->email_verified_at) {
            return redirect()->route('resend')->with('error', 'Email already verified');
        }

        $verificationCode = Str::random(40);
        $user->update([
            'email_verification_code' => $verificationCode,
        ]);

        Mail::to($email)->send(new EmailVerificationMail($user));

        return redirect()->route('login')->with('success', 'Email verification link has been resent. Check your email.');
    }
}
