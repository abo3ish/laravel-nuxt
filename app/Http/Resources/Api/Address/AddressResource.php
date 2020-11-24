<?php

namespace App\Http\Resources\Api\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id' => $this->id,
            'area' => $this->area->name,
            'street' => $this->street,
            'floor_number' => $this->floor_number,
            'flat_number' => $this->flat_number,
            'building_number' => $this->building_number,
            'landmark' => $this->landmark,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
