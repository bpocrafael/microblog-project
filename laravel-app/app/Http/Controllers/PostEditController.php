<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\User;
use App\Models\UserPost;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PostEditController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index()
    {
        return view ();
    }
    public function show(UserPost $post)
    {
        // dd($post);
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

}
