<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    use SoftDeletes;

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
