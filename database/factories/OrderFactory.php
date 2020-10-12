<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use Faker\Generator as Faker;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderType;

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
        'service_provider_type_id' => ServiceProviderType::all()->random()->id,
        'status' => collect([1, 2, 3, 4])->random(),
        'price_to_pay' => $faker->numberBetween(50, 500),
    ];
});
