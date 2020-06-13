<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    //
    public function hospital()
    {
        return $this->hasMany('App\Hospital');
    }

    public function administration()
    {
        return $this->hasMany('App\Administration');
    }

    public function laboratory()
    {
        return $this->hasMany('App\Laboratory');
    }
}
