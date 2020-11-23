<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\Service;
use App\Models\ServiceOrder;
use Faker\Generator as Faker;

$factory->define(ServiceOrder::class, function (Faker $faker) {
    return [
        'order_id' => Order::all()->random()->id,
        'service_id' => Service::all()->random()->id,
        'price' => $faker->numberBetween(10, 500)
    ];
});
