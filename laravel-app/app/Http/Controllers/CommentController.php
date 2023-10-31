<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\UserPost;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Stores user's comment
     */
    public function store(CommentRequest $request, UserPost $post): RedirectResponse
    {
        $result = $this->commentService->storeComment($request, $post);

        return redirect()->back()->with($result['comment'] ? 'success' : 'error', $result['message']);
    }

    /**
     * Deletes a comment
     */
    public function deleteComment(int $id): ?RedirectResponse
    {
        $result = $this->commentService->deleteComment($id);

        return redirect()->back()->with($result['comment'] ? 'success' : 'error', $result['message']);
    }

    /**
     * Updates a comment
     */
    public function editComment(CommentRequest $request, int $id): ?RedirectResponse
    {
        $editedComment = $this->commentService->editComment($id, $request->validated('comment'));

        return redirect()->back()->with($editedComment['comment'] ? 'success' : 'error', $editedComment['message']);
    }
}
