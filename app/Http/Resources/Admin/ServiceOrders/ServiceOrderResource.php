<?php

namespace App\Http\Resources\Admin\ServiceOrders;

use App\Http\Resources\Admin\Services\ServiceResource;
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
            'id' => $this->id,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'service' => new ServiceResource($this->service),
        ];
    }
}
