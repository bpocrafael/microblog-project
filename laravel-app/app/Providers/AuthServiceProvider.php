<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\UserPost;
use App\Policies\UserPostPolicy;
use App\Policies\UserProfilePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        UserPost::class => UserPostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('update-user-profile', [UserProfilePolicy::class, 'update']);
        Gate::define('edit-post', [UserPostPolicy::class, 'edit']);
        Gate::define('delete-post', [UserPostPolicy::class, 'delete']);
        Gate::define('view-post', [UserPostPolicy::class, 'view']);
    }
}
