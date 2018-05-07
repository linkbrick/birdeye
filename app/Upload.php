<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use SoftDeletes;

    protected $fillable = ['account_code','evaluation_id', 'category', 'location', 'file_name', 'system_name', 'file_type', 'file_size'];

    public function evaluation(){
        return $this->belongsTo('App\Evaluation', "evaluation_id");
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function saleInvoice(){
        return $this->hasMany('App\SaleInvoice');
    }
}
