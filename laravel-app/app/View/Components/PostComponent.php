<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\UserPost;

class PostComponent extends Component
{
    public UserPost $post;

    /**
     * Create a new component instance.
     */
    public function __construct(UserPost $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.post');
    }
}
