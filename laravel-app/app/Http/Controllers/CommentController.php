<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\UserPost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function create(UserPost $post): View
    {
        return view('comments.create', compact('post'));
    }

    public function store(CommentRequest $request, UserPost $post): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->with('error', 'You must be logged in to add a comment.');
        }

        $post->comments()->create([
            'user_id' => $user->id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
