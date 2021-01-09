<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseMigrations;
    protected $user, $address;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(['ServiceProviderTypeSeeder', 'ExaminationSeeder']);
        Artisan::call('new:billcycle');
        $this->user = factory(User::class)->create();
        $this->address = factory(Address::class)->create();
    }

    // public function tearDown(): void
    // {
    //     Artisan::call('migrate:fresh');
    //     parent::tearDown();
    // }

    public function test_order_services_successfully()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $response = $this->postJson('api/orders', [
            'address_id' => $this->address->id,
            'items' => [2, 3],
        ])->assertSuccessful();

        $response->assertJsonStructure([
            'data' => ['id', 'uuid'],
            'error',
            'code',
        ])
            ->assertJson([
                "data" => [
                    "id" => $response['data']['id'],
                    "uuid" => $response['data']['uuid'],
                ],
                "error" => null,
                "code" => 200,
            ]);
    }

    public function test_that_we_cant_order_services_that_dont_exist()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $this->postJson('api/orders', [
            'address_id' => $this->address->id,
            'items' => [2, 1100],
        ])->assertStatus(422)
            ->assertJsonStructure([
                'data',
                'error' => ['items'],
                'code',
            ])
            ->assertJsonValidationErrors(['items'], 'error');

    }

    public function test_that_we_cant_order_services_within_different_examination()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $this->postJson('api/orders', [
            'address_id' => $this->address->id,
            'items' => [2, 11],
        ])->assertStatus(422)
            ->assertJsonStructure([
                'data',
                'error' => ['items'],
                'code',
            ])
            ->assertJsonValidationErrors(['items'], 'error');

    }

    public function test_that_we_cant_order_parent_service_that_has_childs()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $this->postJson('api/orders', [
            'address_id' => $this->address->id,
            'items' => [1, 2],
        ])->assertStatus(422)
            ->assertJsonStructure([
                'data',
                'error' => ['items'],
                'code',
            ])
            ->assertJsonValidationErrors(['items'], 'error');

    }

    public function test_order_with_invalid_address()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $this->postJson('api/orders', [
            'address_id' => 11111,
            'items' => [2, 3],
        ])->assertStatus(422)
            ->assertJsonStructure([
                'data',
                'error' => ['address_id'],
                'code',
            ])
            ->assertJsonValidationErrors(['address_id'], 'error');
    }

    public function test_order_with_missing_address()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $this->postJson('api/orders', [
            'items' => [2, 3]
        ])->assertStatus(422)
            ->assertJsonStructure([
                'data',
                'error' => ['address_id'],
                'code',
            ])
            ->assertJsonValidationErrors(['address_id'], 'error');
    }
}
