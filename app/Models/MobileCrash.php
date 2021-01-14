<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileCrash extends Model
{
    protected $fillable = [
        'device_info',
        'crash_log',
        'user_id',
    ];
}
