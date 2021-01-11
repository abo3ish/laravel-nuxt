<?php

namespace Tests\Feature\User;

use AdvertisementSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdsTest extends TestCase
{
    use RefreshDatabase;

    public function test_spash_screen_has_ads()
    {
        $this->seed(AdvertisementSeeder::class);

        $response = $this->get('/api/splash-ad');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'ads' => [
                        'full' => [],
                        'home' => [],
                    ],
                ],
                'error',
                'code',
            ]);
    }

    public function test_splash_and_home_ads_are_valid_images()
    {
        $this->seed(AdvertisementSeeder::class);

        $response = $this->get('/api/splash-ad');

        $response->assertStatus(200);
        foreach ($response['data'] as $ads) {
            foreach ($ads['full'] as $full) {
                $this->get($full['image'])
                    ->assertSuccessful();
            }
            foreach ($ads['home'] as $home) {
                foreach ($home as $ad) {
                    $this->get($ad['image'])
                        ->assertSuccessful();
                }
            }
        }
    }
}
