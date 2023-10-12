<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\UserPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\UploadedFile;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show all instance of auth user's posts.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view('home', compact('user', 'posts'));
    }

    /**
     * Create a new post to user.
     */
    public function create(): View
    {
        $user = auth()->user();
        return view('post.create', compact('user'));
    }

    /**
     * Save the post details to the database using PostService.
     */
    public function store(UserPostRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $validatedData = $request->validated();
        $post = $this->postService->createPost($user, $validatedData);

        if ($post == null) {
            return back()->with('error', 'Failed to create post');
        }

        $success = ['success' => 'Post created successfully'];

        if (!$request->hasFile('image')) {
            return redirect()->route('post.show', ['post' => $post])->with($success);
        }

        $image = $request->file('image');

        if (!$image instanceof UploadedFile || $image == null) {
            return back()->with('error', 'Failed to create post');
        }

        $imagePath = $image->store('images', 'public');

        $post->media()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'file_path' => $imagePath,
        ]);

        return redirect()->route('post.show', ['post' => $post])->with($success);
    }

    /**
     * Show a specific post to view.
     */
    public function show(UserPost $post): View
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the edit form of the post.
     */
    public function edit(UserPost $post): View
    {
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Mofify the existing values of a post using PostService.
     */
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

    /**
     * Soft delete of the post entry to the database.
     */
    public function destroy(UserPost $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }

    /**
     * Reference an existing post to a new post.
     */
    public function share(UserPost $post): RedirectResponse
    {
        $this->postService->sharePost($post);

        $success = ['success' => 'Post shared successfully'];

        return redirect()->route('post.show', ['post' => $post])->with($success);
    }
}
