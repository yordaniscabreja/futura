<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Zone;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityZonesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_university_zones()
    {
        $university = University::factory()->create();
        $zones = Zone::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.zones.index', $university)
        );

        $response->assertOk()->assertSee($zones[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_zones()
    {
        $university = University::factory()->create();
        $data = Zone::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.zones.store', $university),
            $data
        );

        $this->assertDatabaseHas('zones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $zone = Zone::latest('id')->first();

        $this->assertEquals($university->id, $zone->university_id);
    }
}
