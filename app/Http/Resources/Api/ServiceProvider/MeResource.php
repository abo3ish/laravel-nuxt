<?php

namespace App\Http\Resources\Api\ServiceProvider;

use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'image' => $this->image,
            'address' => $this->address,
            'rate' => $this->rate,
            'rate_count' => $this->rate_count,
            'type' => $this->type->title,
            'status' => $this->status,
            'area' => [
                'id' => $this->area_id,
                'name' => $this->area->name,
                'governorate_id' => $this->governorate->id,
            ],
            'token' => $this->token,
        ];
    }
}
