<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantIdentified;
use App\Tenant\Database\DatabaseManager;
use App\Tenant\Manager;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterTenant
{
    protected $db;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
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
        $this->db->createConnection($event->tenant);
    }
}
