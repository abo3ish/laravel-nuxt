<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use DatabaseMigrations;

    protected $user, $address;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(['ServiceProviderTypeSeeder', 'PharmacyCategorySeeder']);
        DB::unprepared(file_get_contents('database/schema/drugs.sql'));
        Artisan::call('new:billcycle');
        $this->user = factory(User::class)->create();
        $this->address = factory(Address::class)->create();
    }

    public function test_guest_cant_checkout_cart()
    {
        $this->postJson('/api/cart/checkout', [
            'items' => collect([
                ['id' => 1, 'quantity' => 1],
                ['id' => 2, 'quantity' => 1],
                ['id' => 3, 'quantity' => 2],
            ])->toJson(),
            'address_id' => $this->address->id,
        ])->assertStatus(401);
    }

    public function test_successfull_checkout_with_only_drugs_in_cart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $response = $this->postJson('/api/cart/checkout', [
            'items' => collect([
                ['id' => 1, 'quantity' => 1],
                ['id' => 2, 'quantity' => 1],
                ['id' => 3, 'quantity' => 2],
            ])->toJson(),
            'address_id' => $this->address->id,
        ])->assertSuccessful();

        $response->assertJsonStructure([
            'data' => ['id', 'uuid'],
            'error',
            'code',
        ]);
    }

    public function test_successfull_checkout_cart_that_has_only_photos()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $image = UploadedFile::fake()->create('image.jpg', 1024);

        $this->postJson('/api/cart/checkout', [
            'images' => [$image],
            'address_id' => $this->address->id,
        ])->assertSuccessful()
            ->assertJsonStructure([
                'data' => ['id', 'uuid'],
                'error',
                'code',
            ]);

    }

    public function test_successfull_checkout_cart_that_has_only_audio_file()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $file = UploadedFile::fake()->create('audio.mp4', 1024);

        $response = $this->postJson('/api/cart/checkout', [
            'audios' => [$file],
            'address_id' => $this->address->id,
        ])->assertSuccessful()
            ->assertJsonStructure([
                'data' => ['id', 'uuid'],
                'error',
                'code',
            ]);

    }

    public function test_successfull_checkout_cart_that_has_drugs_photos_and_audio_files()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $image = UploadedFile::fake()->create('image.jpg', 1024);
        $audio = UploadedFile::fake()->create('audio.mp4', 1024);

        $this->postJson('/api/cart/checkout', [
            'images' => [$image],
            'audios' => [$audio],
            'address_id' => $this->address->id,
        ])->assertSuccessful()
            ->assertJsonStructure([
                'data' => ['id', 'uuid'],
                'error',
                'code',
            ]);
    }

    public function test_cant_checkout_empty_cart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $this->postJson('/api/cart/checkout', [
            'address_id' => $this->address->id,
        ])->assertStatus(400)
            ->assertExactJson([
                'data' => null,
                'error' => ['your cart is empty'],
                'code' => 400,
            ]);

    }
}
