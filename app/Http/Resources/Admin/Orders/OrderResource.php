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
                'name' => $this->user ? $this->user->name : 'مستخدم محذوف',
            ],
            'street' => $this->street,
            'area' => $this->area ? $this->area->name : 'منطقة محذوفة',
            'type' => $this->type,
            'items' => mb_substr($this->items_string, 0, 20, 'UTF-8'),
            'service_provider' => $this->serviceProvider ? [
                'id' => $this->service_provider_id,
                'name' => $this->serviceProvider ? $this->serviceProvider->name : 'مقدم خدمة محذوف',
            ] : null,
            'status' => [
                'code' => $this->status,
                'string' => $this->status_string,
            ],
            'created_at' => $this->created_at,
            'service_provider_type' => $this->serviceProviderType ? $this->serviceProviderType->title : 'نوع مقدم خدمة محذوف',
        ];
    }
}
