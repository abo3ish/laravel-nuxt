<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAttachment extends Model
{
    protected $fillable = [
        'order_id',
        'name',
        'type',
        'size',
        'mime',
        'extension',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
