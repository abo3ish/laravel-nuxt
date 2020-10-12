<?php

namespace App\Models;

use App\Models\Area;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'area_id', 'street', 'building_number', 'floor_number', 'flat_number', 'lat', 'lng'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function getAddressStringAttribute()
    {
        return $this->building_number . " " . $this->street . ", " . $this->area->name;
    }
}
