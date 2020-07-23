<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'city_id', 'street', 'building_number', 'floor_number', 'flat_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
