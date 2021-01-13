<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class PharmacyCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'icon',
        'status',
        'parent_id'
    ];

    public function childs()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function getIconUrlAttribute()
    {
        return getIcon($this->icon);
    }

    public function drugs()
    {
        return $this->hasMany(Drug::class, 'category_id');
    }

    public function discount()
    {
        return $this->morphOne('App\Models\Discount', 'discountable');
    }
}
