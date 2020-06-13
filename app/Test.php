<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    //protected $primaryKey = array('disease_id', 'patient_id','hospital_id','laboratory_id');
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

    public function laboratory()
    {
        return $this->belongsTo('App\Laboratory');
    }
}
