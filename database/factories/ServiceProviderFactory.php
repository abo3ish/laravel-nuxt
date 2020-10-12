<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderType;

$factory->define(ServiceProvider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type_id' => ServiceProviderType::all()->random()->id,
        'phone' => $faker->e164PhoneNumber,
        'area_id' => Area::all()->random()->id,
        'address' => $faker->address,
        'email' => $faker->email,
        'password' => bcrypt('secret'),
        'status' => 1,
        'age' => $faker->numberBetween(22, 50),
        'last_seen' => $faker->dateTime()
    ];
});
