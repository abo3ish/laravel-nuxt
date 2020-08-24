<?php

namespace App\Http\Resources\Admin\OrderServices;

use App\Http\Resources\Admin\Services\ServiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderServiceResource extends JsonResource
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
            'purchase_price' => $this->purchase_price,
            'sell_price' => $this->sell_price,
            'service' => new ServiceResource($this->service),
        ];
    }
}
