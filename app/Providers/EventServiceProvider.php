<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Tenant\TenantWasCreated' => [
            'App\Listeners\Tenant\CreateTenantDatabase',
        ],
        'App\Events\Tenant\TenantIdentified' => [
            'App\Listeners\Tenant\RegisterTenant',
        ],
        'App\Events\Tenant\TenantDatabaseCreated' => [
            'App\Listeners\Tenant\SetupTenantDatabase',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
