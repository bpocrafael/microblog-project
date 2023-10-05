<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\UserPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Services\PostService;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /*
    * View all instances of posts in home page.
    */
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view('home', compact('user', 'posts'));
    }

    /**
     * Show create post page.
     */
    public function create(): View
    {
        $user = auth()->user();
        return view('post.create', compact('user'));
    }

    /**
     * Save post content as new post.
     */
    public function store(UserPostRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $validatedData = $request->validated();

        $post = $this->postService->createPost($user, $validatedData);

        if ($post != null) {
            $success = ['success' => 'Post created successfully'];

            return redirect()->route('post.show', ['post' => $post])->with($success);
        }

        return back()->with('error', 'Failed to create post');
    }

    /*
    * Display specific post.
    */
    public function show(UserPost $post): View
    {
        return view('post.show', ['post' => $post]);
    }
}
