<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'type_id', 'password'];

    protected $hidden = ['password'];
}
