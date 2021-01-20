<?php

namespace Tests\Feature\User;

use AreaSeeder;
use Tests\TestCase;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function test_login_successfully()
    {
        $response = $this->postJson('/api/login', [
            'phone' => $this->user->phone,
            'password' => 'password',
        ])->assertSuccessful();

        $response->assertJsonStructure([
            'data' => ['ads', 'user' => ['token']],
            'error',
            'code',
        ])->assertJson([
            'data' => [
                "ads" => [],
                "user" => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                    'address' => [],
                    'token' => $response['data']['user']['token'],
                ],
            ],
            'error' => null,
            'code' => 200,
        ]);
    }

    public function test_login_with_wrong_credientials_gives_error()
    {
        $this->postJson('/api/login', [
            'phone' => '111111',
            'password' => 'password',
        ])->assertStatus(401)
            ->assertJson([
                'data' => [],
                'error' => [trans('errors.wrong_credentials')],
                'code' => 401,
            ]);
    }

    public function test_fetch_the_current_user()
    {
        $this->postJson('/api/login', [
            'phone' => $this->user->phone,
            'password' => 'password',
        ]);
        $this->actingAs($this->user);

        $this->getJson('/api/me')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data',
                'error',
                'code',
            ])->assertJson([
                'data' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                    'address' => [],
                ],
                'error' => null,
                'code' => 200,
            ]);
    }

    public function test_user_can_register_successfully()
    {
        $this->seed(AreaSeeder::class);

        $response = $this->postJson('api/register', [
            "name" => "Alaa Aboeish",
            "phone" => "01019304360",
            "password" => "123456",
            "area_id" => "1",
            "street" => "Sanadid, Elshershaby st",
            "building_number" => 1,
            "floor_number" => 1,
            "flat_number" => 1,
            "lat" => "33.3342",
            "lng" => "32.442",
            "push_token" => "this is push token for FCM Notification",
            "device_type" => "andriod",
            "details" => "this is device details such as opertation system and mobile model",
        ]);

        $response->assertJsonStructure([
            'data' => ['ads', 'user' => ['token']],
            'error',
            'code',
        ])->assertJson([
            'data' => [
                "ads" => [],
                "user" => [
                    "name" => "Alaa Aboeish",
                    "phone" => "01019304360",
                    'address' => [
                        [
                            'id' => 1,
                            'area' => Area::find(1)->name,
                            "street" => "Sanadid, Elshershaby st",
                            "building_number" => '1',
                            "floor_number" => '1',
                            "flat_number" => '1',
                        ],
                    ],
                    'token' => $response['data']['user']['token'],
                ],
            ],
            'error' => null,
            'code' => 200,
        ]);
    }

    public function test_required_data_will_be_validated()
    {
        Artisan::call('db:seed --class=AreaSeeder');

        $response = $this->postJson('api/register', [
            "name" => "Alaa Aboeish",
            // "phone" => "01019304360",
            // "password" => "123456",
            "street" => "Sanadid, Elshershaby st",
            "building_number" => 1,
            "floor_number" => 1,
            "flat_number" => 1,
            "lat" => "33.3342",
            "lng" => "32.442",
            "push_token" => "this is push token for FCM Notification",
            "device_type" => "andriod",
            "details" => "this is device details such as opertation system and mobile model",
        ])->assertStatus(422);
        $response->assertJsonStructure([
            'data' => [],
            'error' => ['phone', 'password', 'area_id'],
            'code',
        ])->assertJsonValidationErrors(['phone', 'password'], 'error');
    }

    // public function test_log_out()
    // {
    //     $this->actingAs($this->user, 'api');

    //     $this->postJson("/api/logout")
    //         ->assertSuccessful()
    //         ->assertJson([
    //             'success' => true
    //         ]);
    // }
}
