<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advertisement extends Model
{
    protected $fillable = [
        'image',
        'slug',
        'status'
    ];

    public function getImageUrlAttribute()
    {
        return Storage::exists(AdPath($this->image)) ? url(Storage::url(AdPath($this->image))) : url(Storage::url(AdPath('homeAd1.png')));
    }
}
