<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Examination extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'slug', 'status', 'accept_multi'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function getIconUrlAttribute()
    {
        return getIcon($this->icon);
    }
}
