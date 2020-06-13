<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    //
    public $incrementing = false;

    public function wilaya()
    {
        return $this->belongsTo('App\Wilaya');
    }

    public function deseases_hospital()
    {
        return $this->hasMany('App\DeseasesHospital');
    }

    public function test()
    {
        return $this->hasMany('App\Test');
    }

    
}

