<?php

namespace App;

use App\Tenant\Traits\ForTenants;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use ForTenants;

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
