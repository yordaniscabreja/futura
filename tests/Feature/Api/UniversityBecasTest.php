<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Beca;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityBecasTest extends TestCase
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
    public function it_gets_university_becas()
    {
        $university = University::factory()->create();
        $becas = Beca::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.becas.index', $university)
        );

        $response->assertOk()->assertSee($becas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_university_becas()
    {
        $university = University::factory()->create();
        $data = Beca::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.becas.store', $university),
            $data
        );

        $this->assertDatabaseHas('becas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $beca = Beca::latest('id')->first();

        $this->assertEquals($university->id, $beca->university_id);
    }
}
