<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;
use App\Models\ServiceProvider;
use Faker\Provider\ar_SA\Person;
use App\Models\ServiceProviderType;

$factory->define(ServiceProvider::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));

    return [
        'name' => $faker->name,
        'type_id' => ServiceProviderType::all()->random()->id,
        'national_id' => $faker->nationalIdNumber,
        'phone' => $faker->e164PhoneNumber,
        'area_id' => Area::all()->random()->id,
        'address' => $faker->address,
        'image' => $faker->imageUrl(),
        'password' => bcrypt('secret'),
        'rate' => $faker->numberBetween(1, 5),
        'rate_count' => $faker->numberBetween(1, 200),
        'last_seen' => $faker->dateTime(),
        'status' => $faker->numberBetween(1, 7)
    ];
});
