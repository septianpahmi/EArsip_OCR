<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('Admin', function ($user) {
            return $user->hasRole('Admin');
        });
        Gate::define('Tata Usaha', function ($user) {
            return $user->hasRole('Tata Usaha');
        });
    }
}
