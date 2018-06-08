<?php

namespace App;

use App\Tenant\Traits\ForTenants;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected  $fillable = ['entity_id', 'vendor_code','vendor_name','bill_number','bill_date','total_before_tax','tax','total'];

    protected $dates = ['bill_date'];

    use ForTenants;

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
