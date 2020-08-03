<?php

namespace App\Http\Resources\Order;

use App\Models\Order;
use App\Models\OrderDrug;
use App\Models\OrderService;
use App\Http\Resources\Order\OrderDrugResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\OrderServiceResource;

class UserHistoryResource extends JsonResource
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
            'service_provider_id' => $this->service_provider_id,
            'price_to_pay' => $this->price_to_pay,
            'item' => $this->findItemType($this->type, $this->id),
            'status' => Order::whatIsMyStatus($this->status),
            'type' => $this->type
        ];
    }

    public function findItemType($type, $orderId)
    {
        if ($type == 'service') {
            $items = OrderService::where('order_id', $orderId)->get();
            return OrderServiceResource::collection($items);
        } elseif ($type == 'drug') {
            $items = OrderDrug::where('order_id', $orderId)->get();
            return OrderDrugResource::collection($items);
        }
    }
}
