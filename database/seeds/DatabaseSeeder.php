<?php

use App\Models\Order;
use App\Models\ServiceOrder;
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
            // UserSeeder::class,
            AreaSeeder::class,
            // AddressSeeder::class,
            AdvertisementSeeder::class,
            PharmacyCategorySeeder::class,
            ServiceProviderSeeder::class,
        ]);

        if (env('APP_ENV') == 'local') {
            factory(ServiceProvider::class, 200)->create();
            factory(Order::class, 200)->create();
            factory(ServiceOrder::class, 500)->create();
        }

        // $this->call([
        //     ServiceProviderSeeder::class
        // ]);
    }
}
