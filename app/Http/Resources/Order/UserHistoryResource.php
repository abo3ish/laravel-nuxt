<?php

namespace App\Http\Resources\Order;

use App\Models\Order;
use App\Models\DrugOrder;
use App\Models\ServiceOrder;
use App\Http\Resources\Order\DrugOrderResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Order\ServiceOrderResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserHistoryResource extends JsonResource
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
            'service_provider_id' => $this->service_provider_id,
            'price_to_pay' => $this->price_to_pay,
            'item' => $this->findItemType($this->type, $this->id),
            'status' => [
                'code' => $this->status,
                'string' => Order::whatIsMyStatus($this->status)
            ],
            'type' => $this->type
        ];
    }

    public function findItemType($type, $orderId)
    {

        switch ($type) {
            case Order::SERVICE:
                $items = ServiceOrder::where('order_id', $orderId)->get();
                return ServiceOrderResource::collection($items);
                break;

            case Order::PHARMACY:
                $items = DrugOrder::where('order_id', $orderId)->get();
                return PharmacyOrderResource::collection($items);
                break;
        }
    }
}
