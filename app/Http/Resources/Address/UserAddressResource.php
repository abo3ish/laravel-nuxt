<?php

namespace App\Http\Resources\Address;

use App\Models\Area;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'area' => Area::find($this->area_id)->name,
            'street' => $this->street,
            'building_number' => $this->street,
            'floor_number' => $this->street,
            'flat_number' => $this->street,
        ];
    }
}
