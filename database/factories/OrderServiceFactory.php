<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\Service;
use App\Models\OrderService;
use Faker\Generator as Faker;

$factory->define(OrderService::class, function (Faker $faker) {
    return [
        'order_id' => Order::all()->random()->id,
        'service_id' => Service::all()->random()->id,
        'purchase_price' => function (array $order) {
            return Service::find($order['service_id'])->purchase_price;
        },
        'sell_price' => function (array $order) {
            return Service::find($order['service_id'])->sell_price;
        }
    ];
});
