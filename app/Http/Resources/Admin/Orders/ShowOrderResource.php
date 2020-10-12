<?php

namespace App\Http\Resources\Admin\Orders;

use App\Http\Traits\Admin\ResourceTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\Orders\DrugOrderResource;
use App\Http\Resources\Admin\Orders\ServiceOrderResource;

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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'phone' => $this->user->phone,
            ],
            'address' => $this->address->address_string,
            'area' => $this->address->area,
            'type' => $this->type,
            'services' => $this->getServiceOrderResource($this),
            'drugs' => $this->getDrugOrderResource($this),
            'attachments' => $this->attachments,
            'service_provider' => $this->serviceProvider ?? null,
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
            'service_provider_type' => [
                'id' => $this->serviceProviderType->id,
                'title' => $this->serviceProviderType->title
            ],
            'created_at' => $this->created_at,
        ];
    }
}
