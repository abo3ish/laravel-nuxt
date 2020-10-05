<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugOrder extends Model
{
    protected $fillable = [
        'order_id',
        'drug_id',
        'quantity',
        'purchase_price',
        'sell_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
