<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;

class DrugOrder extends Model
{
    protected $fillable = [
        'order_id',
        'drug_id',
        'quantity',
        'price',
        'discount_id',
        'discount_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function updateDrugOrderDiscount($discount_id, $price)
    {
        $this->update([
            'discount_id' => $discount_id,
            'discount_price' => $price
        ]);
    }
}
