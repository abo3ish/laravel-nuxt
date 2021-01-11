<?php

namespace Tests\Feature\User;

use App\Models\Address;
use App\Models\Area;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function test_user_can_see_associated_addresses_successfully()
    {
        $address = factory(Address::class)->create();
        $this->actingAs($address->user);
        $this->getJson('/api/addresses')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $address->id,
                        'area' => $address->area->name,
                        'street' => $address->street,
                        'floor_number' => $address->floor_number,
                        'flat_number' => $address->flat_number,
                        'building_number' => $address->building_number,
                        'lat' => $address->lat,
                        'lng' => $address->lng,
                    ],
                ],
                'error' => null,
                'code' => 200,
            ]);
    }

    public function test_user_can_add_address_successfully()
    {
        $user = factory(User::class)->create();
        $area = factory(Area::class)->create();
        $address = factory(Address::class)->make();

        $this->actingAs($user);

        $this->postJson('api/addresses', [
            'user_id' => $user->id,
            'area_id' => $area->id,
            'street' => $address->street,
            'building_number' => $address->building_number,
            'floor_number' => $address->floor_number,
            'flat_number' => $address->flat_number,
            'lat' => $address->lat,
            'lng' => $address->lng,
        ])->assertJson([
            'data' => [
                'id' => 1,
                'area' => $area->name,
                'street' => $address->street,
                'floor_number' => $address->floor_number,
                'flat_number' => $address->flat_number,
                'building_number' => $address->building_number,
                'lat' => $address->lat,
                'lng' => $address->lng,
            ],
            'error' => null,
            'code' => 200,
        ]);
    }

    public function test_user_can_update_address_successfully()
    {
        $address = factory(Address::class)->create();
        $addressUpdated = factory(Address::class)->make();
        $this->actingAs($address->user);
        $this->putJson('api/addresses/' . $address->id, [
            'street' => $addressUpdated->sreet,
            'area_id' => $addressUpdated->area_id,
            'street' => $addressUpdated->street,
            'building_number' => $addressUpdated->building_number,
            'floor_number' => $addressUpdated->floor_number,
            'flat_number' => $addressUpdated->flat_number,
            'lat' => $addressUpdated->lat,
            'lng' => $addressUpdated->lng,
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $address->id,
                    'area' => $addressUpdated->area->name,
                    'street' => $addressUpdated->street,
                    'floor_number' => $addressUpdated->floor_number,
                    'flat_number' => $addressUpdated->flat_number,
                    'building_number' => $addressUpdated->building_number,
                    'lat' => $addressUpdated->lat,
                    'lng' => $addressUpdated->lng,
                ],
                'error' => null,
                'code' => 200,
            ]);
    }

    public function test_validation_when_update_address()
    {
        $user = factory(User::class)->create();
        $address = factory(Address::class)->create();

        $this->actingAs($user);

        $this->putJson("api/addresses/$address->id", [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(
                ['street', 'area_id', 'lat', 'lng'],
                'error'
            );

    }
    public function test_missing_data_will_throw_validation_error()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->postJson('api/addresses', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(
                ['street', 'area_id', 'lat', 'lng'],
                'error'
            );
    }

    public function test_user_can_see_single_address()
    {
        $address = factory(Address::class)->create();
        $this->actingAs($address->user);
        $this->getJson('/api/addresses/' . $address->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $address->id,
                    'area' => $address->area->name,
                    'street' => $address->street,
                    'floor_number' => $address->floor_number,
                    'flat_number' => $address->flat_number,
                    'building_number' => $address->building_number,
                    'lat' => $address->lat,
                    'lng' => $address->lng,
                ],
                'error' => null,
                'code' => 200,
            ]);
    }

    public function test_use_doesnt_have_access_to_other_address()
    {
        $address1 = factory(Address::class)->create();
        $address2 = factory(Address::class)->create();
        $this->actingAs($address1->user);
        $this->getJson('/api/addresses/' . $address2->id)
            ->assertStatus(403)
            ->assertJson([
                'data' => null,
                'error' => ['Forbidden'],
                'code' => 403,
            ]);

    }

    public function test_guest_user_cant_access_address()
    {
        $this->getJson('/api/addresses')
            ->assertStatus(401)
            ->assertJson([
                'data' => null,
                'error' => [trans('errors.401')],
                'code' => 401
            ]);

        $this->getJson('/api/addresses/1')
            ->assertStatus(401)
            ->assertJson([
                'data' => null,
                'error' => [trans('errors.401')],
                'code' => 401
            ]);
    }

    public function test_delete_address_successfully()
    {
        $address = factory(Address::class)->create();
        $this->actingAs($address->user);

        $this->deleteJson('api/addresses/' . $address->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => null,
                'error' => null,
                'code' => 200,
            ]);
    }

    public function test_only_allowed_user_can_delete_associated_address()
    {
        $address1 = factory(Address::class)->create();
        $address2 = factory(Address::class)->create();
        $this->actingAs($address1->user);

        $this->deleteJson('api/addresses/' . $address2->id)
            ->assertStatus(403)
            ->assertJson([
                'data' => null,
                'error' => ['Forbidden'],
                'code' => 403,
            ]);
    }
}
