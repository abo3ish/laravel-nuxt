<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = ['name', 'scientific_name', 'description', 'image', 'category_id', 'price'];

    public function getImageUrlAttribute()
    {
        return getDrugImage($this->id . ".png");
    }

}
