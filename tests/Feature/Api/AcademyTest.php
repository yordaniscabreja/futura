<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Academy;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademyTest extends TestCase
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
    public function it_gets_academies_list()
    {
        $academies = Academy::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.academies.index'));

        $response->assertOk()->assertSee($academies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academy()
    {
        $data = Academy::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.academies.store'), $data);

        $this->assertDatabaseHas('academies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_academy()
    {
        $academy = Academy::factory()->create();

        $university = University::factory()->create();

        $data = [
            'plan_estudio' => $this->faker->randomNumber(2),
            'recursos_academicos' => $this->faker->randomNumber(2),
            'tecnologia' => $this->faker->randomNumber(2),
            'tamano_grupos' => $this->faker->randomNumber(2),
            'excelencia_profesores' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->putJson(
            route('api.academies.update', $academy),
            $data
        );

        $data['id'] = $academy->id;

        $this->assertDatabaseHas('academies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_academy()
    {
        $academy = Academy::factory()->create();

        $response = $this->deleteJson(route('api.academies.destroy', $academy));

        $this->assertModelMissing($academy);

        $response->assertNoContent();
    }
}
