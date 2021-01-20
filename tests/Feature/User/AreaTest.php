<?php

namespace Tests\Feature\User;

use AreaSeeder;
use Tests\TestCase;
use App\Models\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AreaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_areas_successfully()
    {
        $this->seed(AreaSeeder::class);
        $areas = Area::where('status', 1)->get();
        $areasCount =
            $response = $this->get('/api/areas')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    ['id', 'name']
                ],
                'error',
                'code'
            ])->assertJsonCount($areas->count(), 'data');
    }
}
