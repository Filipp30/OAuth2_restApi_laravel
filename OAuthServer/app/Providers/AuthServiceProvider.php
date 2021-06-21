<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes(function ($router) {
//                $router->forAuthorization();
                $router->forAccessTokens();
                $router->forTransientTokens();
//                $router->forClients();
//                $router->forPersonalAccessTokens();
            });
            Passport::tokensExpireIn(now()->addMinutes(4)); //access token
            Passport::refreshTokensExpireIn(now()->addHours(5));
//            Passport::personalAccessTokensExpireIn(now()->addMinutes(5));
//            Passport::hashClientSecrets(); // client's secrets to be hashed when stored in your database.
        }
    }
}
