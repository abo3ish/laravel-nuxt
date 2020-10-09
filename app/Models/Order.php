<?php

namespace App\Models;

use App\Models\DrugOrder;
use App\Models\ServiceOrder;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
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

    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProviderType::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function serviceOrders()
    {
        return $this->HasMany(ServiceOrder::class);
    }

    public function drugOrders()
    {
        return $this->HasMany(DrugOrder::class);
    }

    public function getServicesStringAttribute()
    {
        $string = '';
        foreach ($this->serviceOrders as $ServiceOrder) {
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

    public function getItems()
    {
        switch ($this->type) {
            case Order::SERVICE:
                $items = $this->serviceOrders;
                break;

            case Order::PHARMACY:
                $items = $this->drugOrders;
                break;
        }
        return $items;
    }

    public function getItemsStringAttribute()
    {
        $string = '';
        switch ($this->type) {
            case Order::SERVICE:
                foreach ($this->serviceOrders as $ServiceOrder) {
                    $string .= $ServiceOrder->service->title . ', ';
                }
                return $string;
                break;

            case Order::PHARMACY:
                foreach ($this->drugOrders as $drugOrder) {
                    $string .= $drugOrder->drug->name . ', ';
                }
                break;
        }
        return trim($string, ", ");
    }

    public function attachments()
    {
        return $this->hasMany(OrderAttachment::class);
    }

    public function createOrderAttachment($file, $type)
    {
        $directory = 'private/' . $type . 's';
        $fileName = $this->id . "-" . auth()->user()->name . "-" .  random_int(1000, 999999) . "." . $file->extension();
        $file->storeAs($directory, $fileName);

        OrderAttachment::create([
            'order_id' => $this->id,
            'type' => $type,
            'name' => $fileName,
            'size' => ($file->getSize() / (1024 * 1024)),
            'extension' => $file->extension()
        ]);
    }

    public function createOrderTextAttachment($text)
    {
        $fileName = $this->id . "-text-" . auth()->user()->name . "-" .  random_int(1000, 999999) . ".png";
        $image = Image::make(public_path('images') . "/background-white.png");
        $directory = getOrderImagePath();

        $image->text($text, 50, 100, function ($font) {
            $font->file(resource_path('fonts/FontsFree-Net-OperatorMono-Medium.ttf'));
            $font->size(30);
        })->save($directory . "/" . $fileName);

        OrderAttachment::create([
            'order_id' => $this->id,
            'type' => 'text',
            'name' => $fileName,
            'size' => ($image->filesize() / (1024)),
            'extension' => 'png'
        ]);
    }
}
