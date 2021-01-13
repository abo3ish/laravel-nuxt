<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'service_id',
        'price',
        'discount_id',
        'discount_price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function updateServiceOrderDiscount($discount_id, $price)
    {
        $this->update([
            'discount_id' => $discount_id,
            'discount_price' => $price
        ]);
    }
}
