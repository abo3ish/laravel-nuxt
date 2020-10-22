<?php

namespace App\Http\Resources\Admin\Advertisement;

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
            'id' => $this->id,
            'slug' => $this->slug,
            'position' => $this->position,
            'image' => $this->image_url,
            'status' => $this->status,
        ];
    }
}
