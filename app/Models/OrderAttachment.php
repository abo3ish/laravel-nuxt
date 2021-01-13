<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAttachment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'name',
        'type',
        'size',
        'mime',
        'extension',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
