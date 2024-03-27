<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Passport::loadKeysFrom(storage_path());
        Passport::tokensExpireIn(now()->add(unit: config('token.expires_in_unit'), value: config('token.expires_in')));
        Passport::refreshTokensExpireIn(now()->add(unit: config('token.refresh.expires_in_unit'), value: config('token.refresh.expires_in')));
        Passport::personalAccessTokensExpireIn(now()->add(unit: config('token.personal.expires_in_unit'), value: config('token.personal.expires_in')));
    }
}
