<?php

namespace App;

use App\Tenant\Models\Tenant;
use App\Tenant\Traits\ForSystem;
use App\Tenant\Traits\IsTenant;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements Tenant
{
    use IsTenant,ForSystem;

    protected $fillable = ['name','uuid'];

}
