<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         *  Mounted Passport routes onto the applications router
         *  Enables methods for generating different types of tokens
         */
        Passport::routes(function ($router) {
            $router->forAccessTokens();
            $router->forPersonalAccessTokens();
            $router->forTransientTokens();
        });

        /**
         * Set Passports 'lifetime' for access tokens.
         */
        Passport::tokensExpireIn(Carbon::now()->addMinutes(15));

        /**
         * Set Passports 'lifetime' for refresh tokens.
         */
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
        //
    }
}
