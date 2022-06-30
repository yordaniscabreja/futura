<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prestige;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityPrestigesTest extends TestCase
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
    public function it_gets_university_prestiges()
    {
        $university = University::factory()->create();
        $prestiges = Prestige::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.prestiges.index', $university)
        );

        $response->assertOk()->assertSee($prestiges[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_prestiges()
    {
        $university = University::factory()->create();
        $data = Prestige::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.prestiges.store', $university),
            $data
        );

        $this->assertDatabaseHas('prestiges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $prestige = Prestige::latest('id')->first();

        $this->assertEquals($university->id, $prestige->university_id);
    }
}
