<?php

namespace Tests\Feature\ServiceProvider;

use Tests\TestCase;
use App\Models\Area;
use GovernorateSeeder;
use ServiceProviderTypeSeeder;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Provider\ar_SA\Person;

class AuthTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    protected $baseUri = '/api/service-provider';

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->faker->addProvider(new Person($this->faker));
    }

    public function test_service_provider_can_login_successfully()
    {
        $this->withExceptionHandling();
        $this->seed([GovernorateSeeder::class, ServiceProviderTypeSeeder::class]);
        $provider = factory(ServiceProvider::class)->create();

        $response = $this->postJson($this->baseUri . '/login', [
            'national_id' => $provider->national_id,
            'password' => 'secret'
        ])->assertSuccessful();

        $this->assertNotNull($response['data']['token']);

        $response->assertJson([
            'data' => [
                'id' => $provider->id,
                'name' => $provider->name,
                'phone' => $provider->phone,
                'image' => $provider->image,
                'rate' => $provider->rate,
                'rate_count' => $provider->rate_count,
                'type' => $provider->type->title,
                'status' => $provider->status,
                'area' => [
                    'id' => $provider->area_id,
                    'name' => $provider->area->name,
                    'governorate_id' => $provider->governorate->id,
                ],
            ],
            'error' => null,
            'code' => 200
        ]);
    }

    public function test_nusrse_can_register_successfully()
    {
        $this->withoutExceptionHandling();
        $this->seed([GovernorateSeeder::class, ServiceProviderTypeSeeder::class]);
        $data = [
            'type_id' => 2,
            'name' => $this->faker->username,
            'national_id' => $this->faker->nationalIdNumber,
            'phone' => '01018304360',
            'area_id' => 5,
            'Syndicate_id' => 22235233,
            'practicing_id' => 54534234,
            'image' => 'image.jpg',
            'password' => 'password',
            'device_type' => 'android',
            'device_type' => 'android',
            'details' => 'android9 - samsung'
        ];

        $response = $this->postJson($this->baseUri . '/register', $data)
            ->assertSuccessful();

        $response->assertJson([
            'data' => [
                'id' => 1,
                'name' => $data['name'],
                'phone' => $data['phone'],
                'image' => $data['image'],
                'rate' => 5,
                'rate_count' => 0,
                'type' => ServiceProviderType::find($data['type_id'])->title,
                'status' => 7,
                'area' => [
                    'id' => $data['area_id'],
                    'name' => Area::find($data['area_id'])->name,
                    'governorate_id' => Area::find($data['area_id'])->governorate->id,
                ],
            ],
            'error' => null,
            'code' => 200
        ]);
    }
}
