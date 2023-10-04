<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\UserPost;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function create(UserPost $post): View
    {
        return view('comments.create', compact('post'));
    }

    public function show(User $user, UserPost $post): View
    {
        $comments = $post->comments;

        return view('components.comment', compact('user', 'post', 'comments'));
    }

    public function store(CommentRequest $request, UserPost $post): RedirectResponse
    {
        $comment = new PostComment([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);
        
        $comment->save();
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
