<?php

use App\Models\Order;
use App\Models\OrderService;
use App\Models\ServiceProvider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ServiceProviderTypeSeeder::class,
            ExaminationSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            CitySeeder::class,
            AddressSeeder::class,
        ]);

        factory(ServiceProvider::class, 50)->create();
        factory(Order::class, 50)->create();
        factory(OrderService::class, 100)->create();
    }
}
