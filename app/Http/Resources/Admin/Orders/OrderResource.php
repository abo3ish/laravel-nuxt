<?php

namespace App\Http\Resources\Admin\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'street' => $this->street,
            'area' => $this->area->name,
            'type' => $this->type,
            'items' => mb_substr($this->items_string, 0, 20, 'UTF-8'),
            'service_provider' => $this->serviceProvider ? [
                'id' => $this->serviceProvider->id,
                'name' => $this->serviceProvider->name,
            ] : null,
            'status' => [
                'code' => $this->status,
                'string' => $this->status_string
            ],
            'created_at' => $this->created_at,
            'service_provider_type' => $this->serviceProviderType->title,
        ];
    }
}
