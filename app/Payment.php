<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['account_code','payment_number','payment_date','payment_amount'];

    public function saleInvoices()
    {
        return $this->belongsToMany(SaleInvoice::class);
    }
}
