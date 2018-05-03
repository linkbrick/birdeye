<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSaleInvoice extends Model
{
    protected $fillable = ['payment_id','sale_invoice_id'];
    public $timestamps = false;
}
