<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressesResource extends JsonResource
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
            'area' => [
                'id' => $this->area_id,
                'name' => $this->area ? $this->area->name : 'منطقة محذوفة'
            ],
            'street' => $this->street,
            'building_number' => $this->building_number,
            'floor_number' => $this->floor_number,
            'flat_number' => $this->flat_number,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
