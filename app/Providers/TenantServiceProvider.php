<?php

namespace App\Providers;

use App\Console\Commands\Tenant\Migrate;
use App\Tenant\Database\DatabaseManager;
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
        $this->app->singleton(Migrate::class, function ($app){
            return new Migrate($app->make('migrator'), $app->make(DatabaseManager::class));
        });
    }
}
