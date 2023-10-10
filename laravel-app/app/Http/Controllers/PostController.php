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

    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view('home', compact('user', 'posts'));
    }

    public function create(): View
    {
        $user = auth()->user();
        return view('post.create', compact('user'));
    }

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

    public function show(UserPost $post): View
    {
        return view('post.show', ['post' => $post]);
    }

    public function edit(UserPost $post): View
    {
        return view('post.edit', ['post' => $post]);
    }

    public function update(UserPostRequest $request, UserPost $post): RedirectResponse
    {
        $validatedData = $request->validated();
        $updated = $this->postService->updatePost($post, $validatedData);

        if ($updated) {
            $success = ['success' => 'Post updated successfully'];

            return redirect()->route('post.show', ['post' => $post])->with($success);
        }

        return redirect()->back()->with('error', 'Failed to update post');
    }

    public function destroy(UserPost $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }

    public function share(UserPost $post): RedirectResponse
    {
        $this->postService->sharePost($post);

        $success = ['success' => 'Post shared successfully'];

        return redirect()->route('post.show', ['post' => $post])->with($success);
    }
}
