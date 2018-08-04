<?php

namespace App;

use App\Tenant\Traits\ForTenants;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected  $fillable = ['entity_id', 'customer_code','customer_name','invoice_number','invoice_date','total_before_tax','tax','total'];

    protected $dates = ['invoice_date'];

    use ForTenants;

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}

/* TEST */