<?php

namespace App\Http\Resources\Admin\ServiceProvider;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowServiceProviderResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'age' => $this->age,
            // 'address' => $this->address,
            'area' => [
                'id' => $this->area_id,
                'name' => $this->area ? $this->area->name : 'منطقة محذوفة'
            ],
            'status' => $this->status,
            'orders' => $this->orders,
            'type' => [
                'id' => $this->type_id,
                'title' => $this->serviceProviderType ? $this->serviceProviderType->title : 'نوع مقدم خدمة محذوف',
            ],
            'last_seen' => $this->last_seen,
            'created_at' => $this->created_at,
        ];
    }
}
