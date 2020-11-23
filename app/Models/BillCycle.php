<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillCycle extends Model
{
    protected $fillable = [
        'from',
        'to',
        'status'
    ];
}
