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
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'area' => $this->area->name,
            'age' => $this->age,
            'rate' => $this->rate,
            'service_provider_type' => [
                'id' => $this->serviceProviderType->id,
                'title' => $this->serviceProviderType->title,
                'slug' => $this->serviceProviderType->slug
            ],
            'status' => $this->status,
            'image' => $this->image_url,
            'token' => $this->token,
        ];
    }
}
