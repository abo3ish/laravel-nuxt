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
            'city' => [
                'id' => $this->city->id,
                'name' => $this->city->name
            ],
            'street' => $this->street,
            'floor_number' => $this->floor_number,
            'flat_number' => $this->flat_number,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
