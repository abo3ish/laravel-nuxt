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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeCurrent()
    {
        return $this->active()->latest()->first();
    }
}
