<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProviderType extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug'
    ];
}
