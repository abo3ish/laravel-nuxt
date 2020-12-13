<?php

namespace App\Models;

use App\Models\BillCycle;
use App\Models\DrugOrder;
use App\Models\ServiceOrder;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'address_id',
        'service_provider_type_id',
        'service_provider_id',
        'bill_cycle_id',
        'type',  // service or pharmacy
        'status',
        'rate',
        'tax_price',
        'actual_price',  // the order price redardless discount, promo or tax
        'subtotal',  // the price before applying tax and delivery price (actual_price - discount)
        // 'discount_id',  // Discount for products without promo codes.
        'discount_price',
        'delivery_price',
        'price_to_pay',  // price of what user gonna pay to the service provider (subtotal + tax_price + delivery_price)
        'is_collected',  // if the order is collected from the service provider.
        'accepted_at',
        'arrived_at',
        'ended_at',
        'canceled_at',
        'profit_percentage',  // based on serviceProvider type
        'actual_profit',  // profit which should be gained before any discount or promotion
        'company_profit',  // the company gained profit after discount
        'service_provider_profit'
    ];
    //TODO: Add property company_profit - service_provider_profit

    protected $dates = [
        'accepted_at',
        'arrived_at',
        'ended_at',
        'canceled_at',
        'created_at',
        'updated_at',
    ];

    public const SERVICE = 'service';
    public const PHARMACY = 'pharmacy';

    public static function whatIsMyStatus($status)
    {
        switch ($status) {
            case '1':
                return 'تحت المراجعة';
                break;

            case '2':
                return 'تم الموافقة';
                break;

            case '3':
                return ' الطلب في الطريق';
                break;

            case '4':
                return ' تم وصول مقدم الخدمة';
                break;

            case '5':
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

    public function attachments()
    {
        return $this->hasMany(OrderAttachment::class);
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
            '1' => 'تحت المراجعة',
            '2' => 'تم الموافقة',
            '3' => 'الطلب في الطريق',
            '4' => 'تم وصول مقدم الخدمة',
            '5' => 'تم التوصيل',
        );
    }

    public static function statusCodes()
    {
        $statuses = [
            [
                'code' => 1,
                'string' => 'تحت المراجعة'
            ],
            [
                'code' => 2,
                'string' => 'تم الموافقة',
            ],
            [
                'code' => 3,
                'string' => 'الطلب في الطريق',
            ],
            [
                'code' => 4,
                'string' => 'تم وصول مقدم الخدمة',
            ],
            [
                'code' => 5,
                'string' => 'تم التوصيل',
            ],
        ];
        return $statuses;
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

    public function createOrderAttachment($file, $type)
    {
        $directory = 'private/' . $type . 's';
        $fileName = $this->id . "-" . auth()->user()->name . "-" .  random_int(1000, 999999) . "." . $file->extension();
        $file->storeAs($directory, $fileName);

        OrderAttachment::create([
            'order_id' => $this->id,
            'type' => $type,
            'name' => $fileName,
            'size' => ($file->getSize() / (1024)),
            'mime' => $file->getMimeType(),
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
            'mime' => $image->mime(),
            'extension' => 'png'
        ]);
    }

    public function billCycle()
    {
        return $this->belongsTo(BillCycle::class);
    }

    public function recalculate()
    {
        $actualPrice = 0;
        $totalDiscount = 0;
        $deliveryPrice = 10;
        foreach ($this->drugOrders as $drugOrder) {
            $actualPrice += $drugOrder->price * $drugOrder->quantity;
            $totalDiscount += $drugOrder->discount_price;
        }
        $this->update([
            'actual_price' => $actualPrice,
            'subtotal' => $actualPrice - $totalDiscount,
            'price_to_pay' => ($actualPrice - $totalDiscount) + $deliveryPrice,
            'discount_price' => $totalDiscount,
            'actual_profit' => ($actualPrice * $this->serviceProviderType->profit_percentage / 100)
        ]);
    }

    public function StoreDiscount($discount_id, $price)
    {
        // $this->update([
        //     'discount_id' => $discount_id,
        //     'discount_price' => $price
        // ]);
    }
}
