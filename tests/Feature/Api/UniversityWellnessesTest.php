<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Wellness;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityWellnessesTest extends TestCase
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
    public function it_gets_university_wellnesses()
    {
        $university = University::factory()->create();
        $wellnesses = Wellness::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.wellnesses.index', $university)
        );

        $response->assertOk()->assertSee($wellnesses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_wellnesses()
    {
        $university = University::factory()->create();
        $data = Wellness::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.wellnesses.store', $university),
            $data
        );

        $this->assertDatabaseHas('wellnesses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $wellness = Wellness::latest('id')->first();

        $this->assertEquals($university->id, $wellness->university_id);
    }
}
