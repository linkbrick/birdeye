<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    //
    protected $fillable = ['account_code','customer_code','customer_name','invoice_number','invoice_date','total_before_tax','tax','total'];

    public function payments()
    {
        return $this->belongsToMany(ARPayment::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
