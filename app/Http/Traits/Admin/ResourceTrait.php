<?php

namespace App\Http\Traits\Admin;

use App\Models\Order;
use App\Http\Resources\Admin\Orders\DrugOrderResource;
use App\Http\Resources\Admin\Orders\ServiceOrderResource;

trait ResourceTrait
{
    public function getItemsResource($order)
    {
        switch ($order->type) {
            case Order::SERVICE:
                return ServiceOrderResource::collection($order->getItems());
                break;

            case Order::PHARMACY:
                return DrugOrderResource::collection($order->getItems());
                break;
        }
    }

    public function getServiceOrderResource($order)
    {
        if ($order->type == Order::SERVICE) {
            return ServiceOrderResource::collection($order->getItems());
        }

        return [];
    }

    public function getDrugOrderResource($order)
    {
        if ($order->type == Order::PHARMACY) {
            return DrugOrderResource::collection($order->getItems());
        }

        return [];
    }
}
