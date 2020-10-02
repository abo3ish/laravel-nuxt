<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'uuid', 'user_id',
        'address_id',
        'type',
        'service_provider_id',
        'price_to_pay',
        'tax_price',
        'discount_price',
        'actual_price',
        'status',
        'is_collected',
        'service_provider_type_id'
    ];

    public const SERVICE = 'service';
    public const PHARMACY = 'pharmacy';

    public static function whatIsMyStatus($status)
    {
        switch ($status) {
            case '0':
                return 'تحت المراجعة';
                break;

            case '1':
                return 'تم الموافقة';
                break;

            case '2':
                return ' الطلب في الطريق';
                break;

            case '3':
                return 'تم التوصيل';
                break;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function services()
    {
        return $this->HasMany(ServiceOrder::class);
    }

    public function drugs()
    {
        return $this->HasMany(DrugOrder::class);
    }

    public function getServicesStringAttribute()
    {
        $string = '';
        foreach($this->services as $ServiceOrder) {
            $string .= $ServiceOrder->service->title . ', ';
        }
        return trim($string, ", ");
    }

    public function getStatusStringAttribute()
    {
        return Self::whatIsMyStatus($this->status);
    }

    public static function statuses()
    {
        return array(
            '0' => 'تحت المراجعة',
            '1' => 'تم الموافقة',
            '2' => 'الطلب في الطريق',
            '3' => 'تم التوصيل',
        );
    }

    public static function generateUuid()
    {
        $uuid = random_int(1000000, 9999999);

        if (Self::where('uuid', $uuid)->first()) {
            self::generateUuid();
        }
        return $uuid;
    }

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class);
    }
}
