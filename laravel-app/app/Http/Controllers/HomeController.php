<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        return view('home', compact('user'));
    }

    /**
     * Logout the user.
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
