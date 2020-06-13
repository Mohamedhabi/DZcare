<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    //
    public $incrementing = false;
    public function deseases_hospital()
    {
        return $this->hasMany('App\DeseasesHospital');
    }

    public function test()
    {
        return $this->hasMany('App\test');
    }
}
