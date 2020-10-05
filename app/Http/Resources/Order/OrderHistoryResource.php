<?php

namespace App\Http\Resources\Order;

use App\Models\Order;
use App\Models\DrugOrder;
use App\Models\ServiceOrder;
use App\Http\Resources\Order\DrugOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\ServiceOrderResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderHistoryResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'user';

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
            'price_to_pay' => $this->price_to_pay,
            'items' => $this->items_string,
            'status' => $this->status_string,
            'type' => $this->type,
            'created_at' => $this->created_at->format('d-m-y h:i')
        ];
    }
}
