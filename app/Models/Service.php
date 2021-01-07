<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'display_order',
        'icon',
        'service_provider_type_id',
        'estimation_from',
        'estimation_to',
        'price',
        'examination_id',
        'parent_id',
        'slug',
        'status'
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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrderDisplay($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    public function scopeActiveChilds($query)
    {
        return $this->childs()->active();
    }
}
