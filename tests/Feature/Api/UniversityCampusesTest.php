<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Campus;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityCampusesTest extends TestCase
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
    public function it_gets_university_campuses()
    {
        $university = University::factory()->create();
        $campuses = Campus::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.campuses.index', $university)
        );

        $response->assertOk()->assertSee($campuses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_campuses()
    {
        $university = University::factory()->create();
        $data = Campus::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.campuses.store', $university),
            $data
        );

        $this->assertDatabaseHas('campuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $campus = Campus::latest('id')->first();

        $this->assertEquals($university->id, $campus->university_id);
    }
}
