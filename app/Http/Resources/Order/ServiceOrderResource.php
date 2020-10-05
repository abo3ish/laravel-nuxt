<?php

namespace App\Http\Resources\Order;

use App\Models\Service;
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
            'service' => [
                'id' => $this->service->id,
                'title' => $this->service->title
            ],
            'price_to_pay' => $this->sell_price
        ];
    }
}
