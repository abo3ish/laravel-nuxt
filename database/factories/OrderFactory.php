<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\ServiceProvider;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'uuid' => random_int(1000000, 9999999),
        'user_id' => User::all()->random()->id,
        'address_id' => Address::all()->random()->id,
        'type' => collect(['service', 'pharmacy'])->random(),
        'service_provider_id' => function () {
            if (collect([0, 1])->random()) {
                return ServiceProvider::all()->random()->id;
            } else {
                return null;
            }
        },
        'status' => collect([0, 1, 2, 3])->random(),
    ];
});
