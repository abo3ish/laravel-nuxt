<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ServiceProvider;
use App\Models\ServiceProviderType;
use Faker\Generator as Faker;

$factory->define(ServiceProvider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type_id' => ServiceProviderType::all()->random()->id,
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'email' => $faker->email,
        'password' => bcrypt('secret')
    ];
});
