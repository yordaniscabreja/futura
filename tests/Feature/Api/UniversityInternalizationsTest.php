<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\University;
use App\Models\Internalization;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityInternalizationsTest extends TestCase
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
    public function it_gets_university_internalizations()
    {
        $university = University::factory()->create();
        $internalizations = Internalization::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.internalizations.index', $university)
        );

        $response->assertOk()->assertSee($internalizations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_internalizations()
    {
        $university = University::factory()->create();
        $data = Internalization::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.internalizations.store', $university),
            $data
        );

        $this->assertDatabaseHas('internalizations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $internalization = Internalization::latest('id')->first();

        $this->assertEquals($university->id, $internalization->university_id);
    }
}
