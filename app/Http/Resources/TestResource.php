<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'disease_id' => $this->disease_id,
            'patient_id' => $this->patient_id,
            'hospital_id' => $this->hospital_id,
            'laboratory_id' => $this->laboratory_id,
            'positif' => $this->positif,
        ];
    }
}
