<?php

namespace App\Http\Controllers;

use App\Http\Requests\SharePostRequest;
use App\Http\Requests\UserPostRequest;
use App\Models\UserPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show the form for post creation.
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image instanceof UploadedFile) {
                if ($this->postService->addPostMedia($user, $post, $image)) {
                    return redirect()->route('post.show', ['post' => $post])->with($success);
                }
            }
            return back()->with('error', 'Failed to create post');
        }
        return redirect()->route('post.show', ['post' => $post])->with($success);
    }

    /**
     * Show a specific post to view.
     */
    public function show(UserPost $post): View
    {
        return view('post.show', ['post' => $post, 'authUser' => auth()->user()]);
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
        $image = $request->file('image');
        $successMessage = '';

        if ($image && !$updated) {
            return redirect()->back()->with('error', 'Failed to update post and/or image');
        }

        if ($image instanceof UploadedFile) {
            $updatedImage = $this->postService->isPostImageUpdatable($post, $image);
            $successMessage = $updatedImage ? 'Image updated successfully' : '';
        }

        if (!$image instanceof UploadedFile || $updated) {
            $successMessage = $successMessage ?: 'Post updated successfully';
        }

        return redirect()->route('post.show', ['post' => $post])->with(['success' => $successMessage]);
    }

    /**
     * Soft delete of the post entry to the database.
     */
    public function destroy(UserPost $post): RedirectResponse
    {
        $this->postService->deletePost($post);

        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }

    /**
     * Show the form for sharing a post.
     */
    public function createShare(UserPost $post): View
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        return view('post.share', ['post' => $post, 'authUser' => $authUser]);
    }


    /**
     * Reference an existing post to a new post.
     */
    public function share(SharePostRequest $sharePostRequest, UserPost $post): RedirectResponse
    {
        $validatedData = $sharePostRequest->validated();
        $sharedPost = $this->postService->sharePost($post, $validatedData);

        $success = ['success' => 'Post shared successfully'];

        return redirect()->route('post.show', ['post' => $sharedPost])->with($success);
    }

    /**
     * Delete image on post
     */
    public function deleteImage(UserPost $post): JsonResponse
    {
        if ($this->postService->deleteImage($post)) {
            return response()->json(['message' => 'Image successfully deleted'], 200);
        } else {
            return response()->json(['message' => 'Image not found'], 404);
        }
    }
}
