<?php

namespace App\Providers;

use App\Interfaces\LikeServiceInterface;
use App\Interfaces\LoginServiceInterface;
use App\Interfaces\PostServiceInterface;
use App\Interfaces\ProfileServiceInterface;
use App\Interfaces\SearchServiceInterface;
use App\Interfaces\UserVerificationServiceInterface;
use App\Models\User;
use App\Observers\VerifiedObserver;
use App\Services\LikeService;
use App\Services\LoginService;
use App\Services\PostService;
use App\Services\ProfileService;
use App\Services\SearchService;
use App\Services\UserVerificationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(VerifiedObserver::class);
    }

    public function register()
    {
        $this->app->bind(SearchServiceInterface::class, SearchService::class);
        $this->app->bind(LikeServiceInterface::class, LikeService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(ProfileServiceInterface::class, ProfileService::class);
        $this->app->bind(UserVerificationServiceInterface::class, UserVerificationService::class);
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
    }
}
