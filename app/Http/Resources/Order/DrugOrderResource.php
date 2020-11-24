<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class DrugOrderResource extends JsonResource
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
            'drug' => [
                'id' => $this->drug->id,
                'name' => $this->drug->name,
                'image' => $this->drug->image_url,
                'quantity' => $this->quantity,
                'price' => $this->price * $this->quantity,
                'price_to_pay' => ($this->price * $this->quantity) - ($this->discount_price),
                'discount_price' => $this->discount_price
            ]
        ];
    }
}
