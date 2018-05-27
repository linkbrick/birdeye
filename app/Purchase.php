<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['account_code','vendor_code','vendor_name','purchase_order_number','purchase_date','total_before_tax','tax','total'];

    public function payments()
    {
        return $this->belongsToMany(APPayment::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
