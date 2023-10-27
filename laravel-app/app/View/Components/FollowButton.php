<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FollowButton extends Component
{
    public User $user;
    /** @var User $authUser */
    public User $authUser;
    public bool $isFollowing;
    public string $followRoute;
    public string $unfollowRoute;

    /**
     * Create a new component instance.
     */
    public function __construct(User $user)
    {
        if (auth()->user()) {
            $this->authUser = auth()->user();
        }
        $this->user = $user;

        $this->isFollowing = $this->authUser->isFollowing($user);
        $this->followRoute = route('follow.update', ['user' => $user->id]);
        $this->unfollowRoute = route('follow.destroy', ['user' => $user->id]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.follow-button');
    }
}
