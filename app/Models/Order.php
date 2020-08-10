<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'address_id', 'type', 'service_provider_id', 'price_to_pay', 'tax_price', 'discount_price', 'actual_price', 'status', 'is_collected'
    ];

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
        return $this->HasMany(OrderService::class);
    }

    public function drugs()
    {
        return $this->HasMany(OrderDrug::class);
    }

    public function getServicesStringAttribute()
    {
        $string = '';
        foreach($this->services as $orderService) {
            $string .= $orderService->service->title . ', ';
        }
        return trim($string, ", ");
    }

    public function getStatusStringAttribute()
    {
        return Self::whatIsMyStatus($this->status);
    }
}
