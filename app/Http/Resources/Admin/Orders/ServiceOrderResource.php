<?php

namespace App\Http\Resources\Admin\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOrderResource extends JsonResource
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
            'id' => $this->service->id,
            'title' => $this->service->title,
            'description' => $this->service->description,
            'service_provider_type' => $this->service->serviceProviderType->title,
            'estimated_price' => $this->service->price,
            'price' => $this->price,
            'price_to_pay' => $this->price - $this->discount_price,
            'discount_price' => $this->discount_price,
            'discount' => $this->discount ? $this->discount->name : ''
        ];
    }
}
