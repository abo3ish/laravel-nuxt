<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'type_id', 'password', 'status', 'age'];

    protected $hidden = ['password'];

    public function type()
    {
        return $this->belongsTo(ServiceProviderType::class, 'type_id');
    }
}
