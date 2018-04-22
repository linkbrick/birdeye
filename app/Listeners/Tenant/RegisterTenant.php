<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantIdentified;
use App\Tenant\Manager;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterTenant
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TenantIdentified  $event
     * @return void
     */
    public function handle(TenantIdentified $event)
    {
        app(Manager::class)->setTenant($event->tenant);
    }
}
