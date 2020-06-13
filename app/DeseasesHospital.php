<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeseasesHospital extends Model
{
    //
    protected $fillable = ['cured'];

    public function disease()
    {
        return $this->belongsTo('App\Disease');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }
}
