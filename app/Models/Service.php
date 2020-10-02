<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'service_provider_type_id',
        'estimation_from',
        'estimation_to',
        'purchase_price',
        'sell_price',
        'examination_id',
        'parent_id',
        'slug'
    ];

    public function childs()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->hasOne(Self::class, 'id' ,'parent_id');
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function getIconUrlAttribute()
    {
        return getIcon($this->icon);
    }

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class);
    }
}
