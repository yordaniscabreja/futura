<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Academy;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityAcademiesTest extends TestCase
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
    public function it_gets_university_academies()
    {
        $university = University::factory()->create();
        $academies = Academy::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.academies.index', $university)
        );

        $response->assertOk()->assertSee($academies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_academies()
    {
        $university = University::factory()->create();
        $data = Academy::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.academies.store', $university),
            $data
        );

        $this->assertDatabaseHas('academies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academy = Academy::latest('id')->first();

        $this->assertEquals($university->id, $academy->university_id);
    }
}
