<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Economy;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityEconomiesTest extends TestCase
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
    public function it_gets_university_economies()
    {
        $university = University::factory()->create();
        $economies = Economy::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.economies.index', $university)
        );

        $response->assertOk()->assertSee($economies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_economies()
    {
        $university = University::factory()->create();
        $data = Economy::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.economies.store', $university),
            $data
        );

        $this->assertDatabaseHas('economies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $economy = Economy::latest('id')->first();

        $this->assertEquals($university->id, $economy->university_id);
    }
}
