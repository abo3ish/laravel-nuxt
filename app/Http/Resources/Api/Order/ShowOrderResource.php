<?php

namespace App\Http\Resources\Api\Order;

use App\Models\Order;
use App\Http\Resources\Api\Drug\DrugResource;
use App\Http\Resources\Order\DrugOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\ServiceOrderResource;
use App\Http\Resources\Admin\Services\ServiceResource;
use App\Http\Resources\Api\Order\OrderAttachmentResource;

class ShowOrderResource extends JsonResource
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
            'type' => $this->type,
            'price_to_pay' => $this->price_to_pay,
            'items' => $this->getItemsResource(),
            'attachments' => OrderAttachmentResource::collection($this->attachments),
            'created_at' => $this->created_at->format('d-m-y h:i')
        ];
    }

    public function getItemsResource()
    {
        switch ($this->type) {
            case Order::SERVICE:
                return ServiceOrderResource::collection($this->getItems());
                break;

            default:
                return DrugOrderResource::collection($this->getItems());
                break;
        }
    }
}
