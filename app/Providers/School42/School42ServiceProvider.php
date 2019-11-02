<?php

namespace App\Providers\School42;

use Illuminate\Support\ServiceProvider;

class School42ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $socialite = $this->app->make(
            'Laravel\Socialite\Contracts\Factory'
        );

        $provider = $socialite->buildProvider(IntraProvider::class, config('services.intra'));

        $socialite->extend('intra', function() use ($provider){
                return $provider;
            }
        );
    }
}
