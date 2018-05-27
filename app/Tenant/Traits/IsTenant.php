<?php

namespace App\Tenant\Traits;

use App\Tenant\Models\Tenant;
use App\TenantConnection;
use Webpatser\Uuid\Uuid;

trait IsTenant
{
    public static function boot()
    {
        parent::boot();

        static::creating(function($tenant){
            $tenant->uuid = Uuid::generate(4);
        });

        static::created(function($tenant){
            $tenant->tenantConnection()->save(static::newDatabaseConnection($tenant));
        });
    }


    public function tenantConnection()
    {
        return $this->hasOne(TenantConnection::class,'company_id','id');
    }

    protected static function newDatabaseConnection(Tenant $tenant)
    {
        return new TenantConnection([
            'database' => 'company_' . $tenant->id
        ]);
    }
}