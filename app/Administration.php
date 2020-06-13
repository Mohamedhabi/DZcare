<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    //
    public $incrementing = false;
    public function wilaya()
    {
        return $this->belongsTo('App\Wilaya');
    }
}
