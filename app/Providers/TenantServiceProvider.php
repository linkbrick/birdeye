<?php

namespace App\Providers;

use App\Tenant\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function(){
            return new Manager();
        });

        // route helper
        Request::macro('tenant', function(){
           return app(Manager::class)->getTenant();
        });

        Blade::if('tenant', function () {
            return app(Manager::class)->hasTenant();
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
