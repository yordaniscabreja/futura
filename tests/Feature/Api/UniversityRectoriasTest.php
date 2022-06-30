<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rectoria;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityRectoriasTest extends TestCase
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
    public function it_gets_university_rectorias()
    {
        $university = University::factory()->create();
        $rectorias = Rectoria::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.rectorias.index', $university)
        );

        $response->assertOk()->assertSee($rectorias[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_university_rectorias()
    {
        $university = University::factory()->create();
        $data = Rectoria::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.rectorias.store', $university),
            $data
        );

        $this->assertDatabaseHas('rectorias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $rectoria = Rectoria::latest('id')->first();

        $this->assertEquals($university->id, $rectoria->university_id);
    }
}
