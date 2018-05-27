<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreated;
use App\Tenant\Models\Tenant;
use Illuminate\Support\Facades\Artisan;

class SetupTenantDatabase
{
    /**
     * Handle the event.
     *
     * @param  TenantDatabaseCreated  $event
     * @return void
     */
    public function handle(TenantDatabaseCreated $event)
    {
        if( $this->migrate($event->tenant) ){
            // temporary disable the seed, nothing to seed yet
            //$this->seed($event->tenant);
        }
    }

    protected function migrate(Tenant $tenant)
    {
        $migration = Artisan::call('tenants:migrate',[
            '--tenants' => [$tenant->id]
        ]);

        return $migration ===0;

    }

    protected function seed(Tenant $tenant)
    {
        return Artisan::call('tenants:seed',[
            '--tenants' => [$tenant->id]
        ]);
    }
}
