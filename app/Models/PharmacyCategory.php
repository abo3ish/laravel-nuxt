<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PharmacyCategory extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'icon', 'status', 'parent_id'];

    public function childs()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function getIconUrlAttribute()
    {
        return Storage::exists(iconPath($this->icon)) ? url(Storage::url(iconPath($this->icon))) : null;
    }
}
