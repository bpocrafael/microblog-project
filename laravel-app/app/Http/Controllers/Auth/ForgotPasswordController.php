<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Services\ForgotPasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    protected ForgotPasswordService $forgotPasswordService;

    /**
     * Constructor
     */
    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    /**
     * Show the email form for forgot password.
     */
    public function showRequestForm(): View
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the email provided.
     */
    public function sendResetLinkEmail(ForgotPasswordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        return $this->forgotPasswordService->sendResetLink($validatedData);
    }

    /**
     * Show the reset form for password.
     */
    public function showResetForm(string $token): View
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /**
     * Reset the password.
     */
    public function reset(ResetPasswordRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if ($user === null) {
            return back()->withErrors(['email' => ["Email not found"]]);
        }

        return $this->forgotPasswordService->reset($user, $validatedData);
    }
}
