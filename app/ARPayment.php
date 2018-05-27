<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ARPayment extends Model
{
    //
    protected $fillable = ['account_code','payment_number','payment_date','payment_amount'];
    protected $table = "ar_payments";

    public function saleInvoices()
    {
        return $this->belongsToMany(SaleInvoice::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
