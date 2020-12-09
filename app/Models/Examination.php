<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Examination extends Model
{
    protected $fillable = [
        'title',
        'description',
        'display_order',
        'icon',
        'slug',
        'status',
        'accept_multi'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function getIconUrlAttribute()
    {
        return getIcon($this->icon);
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeOrderDisplay()
    {
        return $this->orderBy('display_order', 'asc');
    }
}
