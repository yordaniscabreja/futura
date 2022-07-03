<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Convenio;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityConveniosTest extends TestCase
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
    public function it_gets_university_convenios()
    {
        $university = University::factory()->create();
        $convenios = Convenio::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.convenios.index', $university)
        );

        $response->assertOk()->assertSee($convenios[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_university_convenios()
    {
        $university = University::factory()->create();
        $data = Convenio::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.convenios.store', $university),
            $data
        );

        $this->assertDatabaseHas('convenios', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $convenio = Convenio::latest('id')->first();

        $this->assertEquals($university->id, $convenio->university_id);
    }
}
