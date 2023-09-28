<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show login form page.
     *
     * @return View
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     *
     * @param UserPostRequest $request
     * @return View
     */
    public function store(UserPostRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();

        /**
         * @var \App\Models\User $user
         */
        $user->posts()->create([
            'content' => $validatedData['content'],
        ]);

        return view('post.display');
    }
}
