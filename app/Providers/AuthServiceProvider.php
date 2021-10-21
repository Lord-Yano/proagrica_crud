<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Using gates to lock users from certain pages

        // define new gate
        Gate::define('logged-in', function ($user) {
            return $user; // returns NULL if there is no user
        });

        // Check if Admin
        Gate::define('is-admin', function ($user) {
            return $user->hasAnyRole('admin');  // returns NULL if there is no user
            //return $user->hasAnyRoles(['admin', 'author']); // Gate will pass if any one of the roles exists
        });

        //
    }
}
