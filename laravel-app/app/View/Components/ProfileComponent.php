<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\UserPost;

class ProfileComponent extends Component
{
    public ?UserPost $post;
    public ?User $authUser;

    /**
     * Create a new component instance.
     */
    public function __construct(User $authUser, UserPost $post)
    {
        /** @var User $authUser */
        $this->authUser = $authUser;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.profile');
    }
}
