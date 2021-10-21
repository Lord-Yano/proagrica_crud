<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Let Fortify know where register and login view are

        // Register view
        Fortify::registerView(function () {

            //return register view from auth folder | form where user registers
            return view(view: 'auth.register');
        });

        //Login view
        Fortify::loginView(function () {

            // return login view from auth
            return view(view: 'auth.login');
        });

        /** 
         * Password reset creates random token.
         *  Emails token and url to user.
         *  Upon click, url returns to app to the view below
         *  Token needs to be picked up inside the view and passed over when password reset executes
         *  request will pick up token from view
         */

        Fortify::resetPasswordView(function ($request) {
            // closure returns view
            return view('auth.reset-password', ['request' => $request]);
        });

        // Password reset view for user not admin
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        // Verify email view
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });
    }
}
