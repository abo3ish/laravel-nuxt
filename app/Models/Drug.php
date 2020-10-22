<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = [
        'name',
        'scientific_name',
        'description',
        'image',
        'category_id',
        'price'
    ];

    public function getImageUrlAttribute()
    {
        $image = $this->image ? $this->image : $this->id . ".png";
        return getDrugImage($image);
    }

    public function category()
    {
        return $this->belongsTo(PharmacyCategory::class);
    }

}
