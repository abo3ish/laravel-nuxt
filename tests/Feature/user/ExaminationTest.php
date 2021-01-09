<?php

namespace Tests\Feature\user;

use AdvertisementSeeder;
use App\Models\Examination;
use ExaminationSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ServiceProviderTypeSeeder;
use Tests\TestCase;

class ExaminationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_examination_services()
    {
        $this->seed([ServiceProviderTypeSeeder::class, ExaminationSeeder::class]);

        $examinations = Examination::orderDisplay()->with('services')->get();

        $response = $this->get('/api/examinations');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id', 'title', 'description',
                        'icon', 'accept_multi', 'ads' => [],
                        'status',
                        'services' => [
                            [
                                'id', 'title', 'examination_id',
                                'icon', 'estmation_from', 'estimation_to',
                                'status',
                                'sub_services' => [
                                    [
                                        'id', 'title', 'examination_id',
                                        'icon', 'estmation_from', 'estimation_to',
                                        'status',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'error',
                'code',
            ])->assertJsonCount($examinations->count(), 'data');
    }

    public function test_examination_ads()
    {
        $this->seed([AdvertisementSeeder::class, ServiceProviderTypeSeeder::class, ExaminationSeeder::class]);

        $response = $this->get('/api/examinations')
            ->assertStatus(200);
        foreach ($response['data'] as $examination) {
            foreach ($examination['ads'] as $ads) {
                foreach ($ads as $ad) {
                    $this->assertContains(exif_imagetype($ad['image']), [2, 3]);
                }
            }
        }
    }

    public function test_examination_icons()
    {
        $this->withoutExceptionHandling();
        $this->seed([ServiceProviderTypeSeeder::class, ExaminationSeeder::class]);

        $response = $this->get('/api/examinations')
            ->assertStatus(200);
        foreach ($response['data'] as $examination) {
            $this->assertContains(exif_imagetype($examination['icon']), [2, 3]);
            foreach ($examination['services'] as $service) {
                $this->assertContains(exif_imagetype($service['icon']), [2, 3]);
            }
        }
    }
}
