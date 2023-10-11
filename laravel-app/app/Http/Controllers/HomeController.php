<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class HomeController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $posts = $user->posts()
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('home', compact('user', 'posts'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
