<?php

namespace App\Http\Traits;

use App\Models\DrugOrder;
use App\Models\ServiceOrder;

Trait DiscountTrait {

    public function handleDiscount($item, $subOrder)
    {
        if ($subOrder instanceof ServiceOrder) {
            $discount = $item->serviceProviderType->discount;
            $priceToDiscount = $item->price;
            if ($discount && $discount->status) {
                $discountValue = $this->calculateDiscount($priceToDiscount, $discount);
                if ($this->isValidDiscount($discountValue, $discount)) {
                    $subOrder->updateServiceOrderDiscount($discount->id, $discountValue);
                    return $discountValue;
                }
            }
        } elseif ($subOrder instanceof DrugOrder) {
            $discount = $item->category->discount;
            $priceToDiscount = $item->price * $subOrder->quantity;
            if ($discount && $discount->status) {
                $discountValue = $this->calculateDiscount($priceToDiscount, $discount);
                if ($this->isValidDiscount($discountValue, $discount)) {
                    $subOrder->updateDrugOrderDiscount($discount->id, $discountValue);
                    return $discountValue;
                }
            }
        }
        return 0;
    }

    public function calculateDiscount($price, $discount)
    {
        return $price * $discount->percentage / 100;
    }

    public function isValidDiscount($price, $discount)
    {
        if ($price > $discount->max && $discount->start_at < now() && $discount->end_at > now() && $discount->usage_total < $discount->usage_limit) {
            return true;
        }
        return false;
    }


}
