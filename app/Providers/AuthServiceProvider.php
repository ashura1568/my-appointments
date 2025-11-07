<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap services.
     */
     public function boot()
    {
        $this->registerPolicies();

        //Passport::routes(); // <---
    }
}
