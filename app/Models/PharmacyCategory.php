<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyCategory extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'icon', 'status', 'parent_id'];

    public function childs()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }
}
