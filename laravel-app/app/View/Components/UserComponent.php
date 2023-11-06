<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserComponent extends Component
{
    public User $user;
    public ?User $authUser;

    /**
     * Create a new component instance.
     */
    public function __construct(User $user)
    {
        $this->authUser = auth()->user();
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.user-component');
    }
}
