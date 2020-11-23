<?php

namespace App\Http\Resources\Admin\Orders;

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
            'id' => $this->drug->id,
            'name' => $this->drug->name,
            'image' => $this->drug->image_url,
            'price_to_pay' => $this->sell_price
        ];
    }
}
