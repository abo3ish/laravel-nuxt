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
        $service = Service::find($this->service_id);
        return [
            'order_id' => $this->order_id,
            'service' => [
                'id' => $service->id,
                'title' => $service->title
            ],
        ];
    }
}
