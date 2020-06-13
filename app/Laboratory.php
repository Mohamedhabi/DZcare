<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    //
    public $incrementing = false;
    public function wilaya()
    {
        return $this->belongsTo('App\Wilaya');
    }

    public function test()
    {
        return $this->hasMany('App\test');
    }
}
