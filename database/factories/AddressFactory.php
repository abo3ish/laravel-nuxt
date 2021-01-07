<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use App\Models\Area;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'area_id' => factory(Area::class),
        'street' => $faker->address,
        'building_number' => $faker->buildingNumber,
        'floor_number' => random_int(1, 5),
        'flat_number' => random_int(1, 30),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude
    ];
});
