<?php

namespace App\Http\Resources\ServiceProvider\Order;

use App\Models\Order;
use App\Http\Traits\Admin\ResourceTrait;
use App\Http\Resources\Order\DrugOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\ServiceOrderResource;

class ShowOrderResource extends JsonResource
{
    use ResourceTrait;
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
            'type' => $this->type,
            'price_to_pay' => $this->price_to_pay,
            'items' => $this->getItemsResource($this),
            'address' => $this->address->address_string,
            'tax_price' => $this->tax_price,
            'price_to_pay' => $this->price_to_pay,
            'actual_price' => $this->actual_price,
            'accepted_at' => $this->accepted_at->format('d-m-y h:i'),
            'created_at' => $this->created_at->format('d-m-y h:i')
        ];
    }
}
