<?php

namespace App\Http\Traits;

Trait OrderTrait {
    public function calculateCompanyProfit($order)
    {
        return $order->price_to_pay * $order->serviceProviderType->profit_percentage / 100;
    }

    public function calculateServiceProviderProfit($order)
    {
        return $order->price_to_pay * (100 - $order->serviceProviderType->profit_percentage) / 100;
    }

    public function calculateActualProfit($order)
    {
        return ($order->actual_price * $order->serviceProviderType->profit_percentage) / 100;
    }
}
