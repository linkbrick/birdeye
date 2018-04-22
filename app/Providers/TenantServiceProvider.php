<?php

namespace App\Providers;

use App\Tenant\Manager;
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
