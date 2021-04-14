<?php

namespace Tests\Feature\ServiceProvider;

use AreaSeeder;
use Tests\TestCase;
use App\Models\Area;
use GovernorateSeeder;
use ServiceProviderTypeSeeder;
use Illuminate\Http\UploadedFile;
use App\Models\ServiceProviderType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $defaultRequest;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed([GovernorateSeeder::class, AreaSeeder::class, ServiceProviderTypeSeeder::class]);

        $this->defaultRequest = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->e164PhoneNumber,
            'area_id' => Area::get()->random()->id,
            'national_id_number' => $this->faker->randomNumber(6),
            'national_id_image' => UploadedFile::fake()->create('national_id.jpg', 1024),
            "push_token" => "this is push token for FCM Notification",
            "device_type" => "andriod",
            "details" => "this is device details such as opertation system and mobile model",
        ];
    }

    public function test_register_as_a_delivery_successfully()
    {
        $this->withExceptionHandling();

        $deliveryId = ServiceProviderType::where('slug', ServiceProviderType::DELIVERY)->first()->id;

        $this->postJson('api/service-provider/register/' . $deliveryId, array_merge($this->defaultRequest, [
            'driving_license_number' => $this->faker->randomNumber(4),
            'driving_license_image' => UploadedFile::fake()->create('driving_license.jpg', 1024),

        ]))->assertSuccessful();
    }

    public function test_register_as_a_nurse_successfully()
    {
        $this->withExceptionHandling();

        $nurseId = ServiceProviderType::where('slug', ServiceProviderType::NURSE)->first()->id;

        $this->postJson('api/service-provider/register/' . $nurseId, array_merge($this->defaultRequest, [
            'syndicate_id_number' => $this->faker->randomNumber(4),
            'syndicate_id_image' => UploadedFile::fake()->create('driving_license.jpg', 1024),
            'practicing_id_number' => $this->faker->randomNumber(4),
            'practicing_id_image' => UploadedFile::fake()->create('driving_license.jpg', 1024),

        ]))->assertSuccessful();
    }

    public function test_register_as_a_delivery_with_validation_errors()
    {
        $this->withExceptionHandling();

        $nurseId = ServiceProviderType::where('slug', ServiceProviderType::DELIVERY)->first()->id;

        $this->postJson('api/service-provider/register/' . $nurseId, array_merge($this->defaultRequest))->assertStatus(422)
            ->assertJsonValidationErrors(['driving_license_number', 'driving_license_image'], 'error');
    }

    public function test_register_as_a_nurse_with_validation_errors()
    {
        $this->withExceptionHandling();

        $nurseId = ServiceProviderType::where('slug', ServiceProviderType::NURSE)->first()->id;

        $this->postJson('api/service-provider/register/' . $nurseId, array_merge($this->defaultRequest))->assertStatus(422)
            ->assertJsonValidationErrors(['syndicate_id_number', 'syndicate_id_image', 'practicing_id_number', 'practicing_id_image'], 'error');
    }
}
