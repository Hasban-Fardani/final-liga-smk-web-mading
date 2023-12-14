<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->permission == 'admin';
        });

        Gate::define('creator', function ($user) {
           return $user->permission == 'creator'; 
        });
        
        Gate::define('user', function ($user) {
            return $user->permission == 'user';
        });

        Gate::define('create-post', function ($user) {
            return $user->permission == 'creator' || $user->permission == 'admin'; 
         });

        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->id == $post->user_id && ($user->permission == 'admin' || $user->permission == 'creator');
        });
    }
}
