<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPurchase extends Model
{
    protected $fillable = ['payment_id','purchase_id'];
    public $timestamps = false;
}
