<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;
use App\Models\UserPost;
use App\Models\PostComment;


class CommentComponent extends Component
{
    public UserPost $post;
    public User $user;
    public PostComment $comments;

    /**
     * Create a new component instance.
     */
    public function __construct(UserPost $post, User $user, PostComment $comments)
    {
        $this->post = $post;
        $this->comments = $comments;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.comment');
    }   
}
