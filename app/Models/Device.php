<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'device_type',
        'process_type',
        'deviceable_id',
        'deviceable_type',
        'deviceable_ip',
        'details',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function deviceable()
    {
        return $this->morphTo();
    }
}
