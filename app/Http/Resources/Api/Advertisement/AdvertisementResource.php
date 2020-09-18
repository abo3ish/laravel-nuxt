<?php

namespace App\Http\Resources\Api\Advertisement;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
            // 'slug' => $this->slug,
            'image' => $this->image,
            // 'position' => $this->position
        ];
    }
}
