<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index() : View
    {
        /** @var User $user */
        $user = auth()->user();
        $posts = $user->posts;
        return view('home', compact('user', 'posts'));
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
