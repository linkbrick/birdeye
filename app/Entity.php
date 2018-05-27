<?php

namespace App;

use App\Tenant\Traits\ForTenants;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use ForTenants;
}
