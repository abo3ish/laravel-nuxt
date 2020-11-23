<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'percentage',
        'max_price',
        'usage_total',
        'usage_limit',
        'start_at',
        'end_at',
        'discountable_type',
        'discountable_id',
        'status',
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
    ];

    public function discountable()
    {
        return $this->morphTo();
    }
}
