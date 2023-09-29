<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\VerifiedObserver;
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
}
