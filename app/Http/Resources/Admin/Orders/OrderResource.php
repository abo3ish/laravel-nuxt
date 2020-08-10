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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'address' => $this->address->street,
            'type' => $this->type,
            'services' => mb_substr($this->services_string, 0, 20, 'UTF-8'),
            'service_provider' => $this->serviceProvider ? [
                'id' => $this->serviceProvider->id,
                'name' => $this->serviceProvider->name,
            ] : null,
            'status' => [
                'code' => $this->status,
                'string' => $this->status_string
            ]
        ];
    }
}
