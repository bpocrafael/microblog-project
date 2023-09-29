<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\UserPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /* 
    * View all instances of posts in home page.
    */
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts->orderByAsce('created_at')->get();
    
        return view('home', compact('user', 'posts'));
    }    

    /**
     * Show create post page.
     */
    public function create() : View
    {
        $user = auth()->user();
        return view('post.create', compact('user'));
    }

    /**
     * Save post content as new post.
     */
    public function store(UserPostRequest $request) : RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $validatedData = $request->validated();

        /** @var \App\Models\User $user */
        $post = $user->posts()->create([
            'content' => $validatedData['content'],
        ]);

        if ($post) {
            return redirect()->route('post.show', ['post' => $post->id])->with('success', 'Post created successfully');
        } else {
            return back()->with('error', 'Failed to create post');
        }
    }
    /* 
    * Display specific post.
    */
    public function show($post) : View
    {
        $post = UserPost::findOrFail($post);
        return view('post.show', compact('post'));
    }
}
