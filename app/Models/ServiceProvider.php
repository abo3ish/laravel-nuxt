<?php

namespace App\Models;

use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ServiceProvider extends Authenticatable
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name',
        'type_id',
        'national_id',
        'phone',
        'address',
        'area_id',
        'password',
        'rate',
        'rate_count',
        'status',
        'image',
        'push_token',
        'lat',
        'lng'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'status' => 'integer',
        'area_id' => 'integer',
        'rate' => 'integer',
        'rate_count' => 'integer',
    ];

    protected $date = [
        'last_seen'
    ];

    /* Type */
    public function type()
    {
        return $this->belongsTo(ServiceProviderType::class, 'type_id');
    }

    /**
     * @return array
     */
    public static function Statuses()
    {
        return [
            1   => 'available',
            2   => 'idle',
            3   => 'busy',
            4   => 'offline',
            5   => 'waiting_approval',
            6   => 'suspend',
            7   => 'under_revision',
        ];
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

    public function governorate()
    {
        return $this->area->governorate();
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
