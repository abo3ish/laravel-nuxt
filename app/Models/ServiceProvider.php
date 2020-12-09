<?php

namespace App\Models;

use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ServiceProvider extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'type_id',
        'area_id',
        'password',
        'status',
        'age',
        'rate',
        'image',
        'push_token',
        'lat',
        'lng'
    ];

    protected $hidden = ['password'];

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

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class, 'type_id');
    }

    public function getPhotoUrlAttribute()
    {
        return getServiceProviderImage($this->image);
    }

    public function updatePushToken($pushToken)
    {
        $this->update([
            'push_token' => $pushToken
        ]);
    }

}
