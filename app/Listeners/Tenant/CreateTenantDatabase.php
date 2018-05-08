<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreated;
use App\Events\Tenant\TenantWasCreated;
use App\Tenant\Database\DatabaseCreator;

class CreateTenantDatabase
{
    protected $databaseCreator;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseCreator $databaseCreator)
    {
        $this->databaseCreator = $databaseCreator;
    }

    /**
     * Handle the event.
     *
     * @param  TenantWasCreated $event
     * @return void
     */
    public function handle(TenantWasCreated $event)
    {
        if (!$this->databaseCreator->create($event->tenant)) {
            throw new \Exception('Database Failed to be created.');
        }

        // @todo event
        event(new TenantDatabaseCreated($event->tenant));
    }
}
