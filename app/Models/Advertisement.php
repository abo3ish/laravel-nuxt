<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    protected $fillable = [
        'image',
        'slug',
        'position',
        'status'
    ];

    public function getImageUrlAttribute()
    {
        return getAd($this->image);
    }
}
