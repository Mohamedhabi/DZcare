<?php

namespace App\Http\Resources;
use App\Http\Controllers\HospitalController;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        //echo(str($this->id));
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'places' => $this->places,
            'wilaya_id' => $this->wilaya_id,
        ];
    }
}
