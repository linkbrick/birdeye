<?php

namespace App\Tenant\Database;


use App\Tenant\Models\Tenant;

class DatabaseManager
{
    public function createConnection(Tenant $tenant)
    {
        dd($this->getTenantConnection($tenant));
        config()->set('database.connections.tenant',$this->getTenantConnection($tenant));
    }

    protected function getTenantConnection(Tenant $tenant)
    {
        return array_merge(config()->get('database.connections.pgsql'),$tenant->tenantConnection->only('database'));
    }

}