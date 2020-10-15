<?php

namespace App\Http\Resources\ServiceProvider\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderHistoryResource extends JsonResource
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
            'uuid' => $this->uuid,
            'price_to_pay' => $this->price_to_pay,
            'items' => $this->items_string,
            'status' => $this->status_string,
            'type' => $this->type,
            'created_at' => $this->created_at->format('d-m-y h:i')
        ];
    }
}
