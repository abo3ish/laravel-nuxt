<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyOrder extends Model
{
    protected $fillable = ['order_id', 'drug_id', 'quantity', 'purchase_price', 'sell_price'];
}
