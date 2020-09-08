<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function childs()
    {
        return $this->hasMany(Self::class, 'parent_id');
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
