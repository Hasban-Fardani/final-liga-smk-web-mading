<?php

namespace App\Providers;

use App\Services\Class\UserService;
use App\Services\Interface\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // bind services
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}
