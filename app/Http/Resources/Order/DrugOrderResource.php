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
                'title' => $this->drug->name,
                'image' => $this->drug->image_url
            ],
            'price_to_pay' => $this->sell_price
        ];
    }
}
