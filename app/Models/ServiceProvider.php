<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ServiceProvider extends Authenticatable implements JWTSubject
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'type_id', 'password', 'status', 'age'];

    protected $hidden = ['password'];

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function type()
    {
        return $this->belongsTo(ServiceProviderType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function devices()
    {
        return $this->morphMany(Device::class, 'deviceable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class, 'type_id');
    }
}
