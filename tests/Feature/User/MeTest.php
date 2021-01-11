<?php

namespace Tests\Feature\User;

use App\Models\Address;
use App\Models\User;
use Tests\TestCase;

class MeTest extends TestCase
{
    public function test_can_fetch_user_info_successfully()
    {
        $address = factory(Address::class)->create();
        $this->actingAs($address->user);

        $this->getJson('/api/me')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $address->user->id,
                    'name' => $address->user->name,
                    'email' => $address->user->email,
                    'phone' => $address->user->phone,
                    'address' => [[

                        'id' => $address->id,
                        'area' => $address->area->name,
                        'street' => $address->street,
                        'building_number' => $address->building_number,
                        'floor_number' => $address->floor_number,
                        'flat_number' => $address->flat_number,
                    ]],
                    'token' => null,
                ],
                'error' => [],
                'code' => 200,
            ]);
    }

    public function test_user_can_update_info_sucessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->postJson('api/me', [
            'name' => 'Abo3ish',
            'phone' => '0100101010',
        ])->assertStatus(200)
            ->assertJson([
                'data' => null,
                'error' => null,
                'code' => 200,
            ]);

    }

    public function test_update_me_with_empty_string_validation()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->postJson('api/me', [
            'name' => '',
            'phone' => '',
        ])->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'phone'], 'error');
    }

    public function test_update_me_with_already_register_phone()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $this->actingAs($user1);

        $this->postJson('api/me', [
            'name' => 'Test',
            'phone' => $user2->phone,
            'email' => 'notValidaEmail'
        ])->assertStatus(422)
            ->assertJsonValidationErrors(['phone', 'email'], 'error');

    }

    public function test_guest_cant_fetch_me()
    {
        $this->getJson('api/me')
            ->assertStatus(401)
            ->assertJson([
                'data' => null,
                'error' => [trans('errors.401')],
                'code' => 401,
            ]);
    }
}
