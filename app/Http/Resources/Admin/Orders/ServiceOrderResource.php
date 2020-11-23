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
            'price_to_pay' => $this->sell_price,
            'estimated_price' => $this->service->sell_price
        ];
    }
}
