<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['account_code','code'];

    public function upload(){
        return $this->hasMany('App\Upload');
    }
}
