<?php

namespace App\Http\Resources\Admin\Orders;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\ServiceOrders\ServiceOrderResource;

class ShowOrderResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'address' => $this->address->street,
            'type' => $this->type,
            'services' => ServiceOrderResource::collection($this->serviceOrders),
            'service_provider' => $this->serviceProvider ? [
                'id' => $this->serviceProvider->id,
                'name' => $this->serviceProvider->name,
            ] : null,
            'status' => [
                'code' => $this->status,
                'string' => $this->status_string
            ],
            'prices' => [
                'price_to_pay' => $this->price_to_pay,
                'discount_price' => $this->discount_price,
                'tax_price' => $this->tax_price,
                'actual_price' => $this->actual_price,
            ],
            'is_collected' => $this->is_collected,
        ];
    }
}
