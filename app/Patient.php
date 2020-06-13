<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['first_name', 'last_name', 'password','email','address','phone'];

    //
    public function deseases_hospital()
    {
        return $this->hasMany('App\DeseasesHospital');
    }

    public function test()
    {
        return $this->hasMany('App\test');
    }
}
