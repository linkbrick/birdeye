<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class APPayment extends Model
{
    protected $fillable = ['account_code','payment_number','payment_date','payment_amount'];
    protected $table = "ap_payments";

    public function saleInvoices()
    {
        return $this->belongsToMany(Purchase::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
