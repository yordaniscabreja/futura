<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Wellness;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WellnessTest extends TestCase
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
    public function it_gets_wellnesses_list()
    {
        $wellnesses = Wellness::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wellnesses.index'));

        $response->assertOk()->assertSee($wellnesses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_wellness()
    {
        $data = Wellness::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wellnesses.store'), $data);

        $this->assertDatabaseHas('wellnesses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wellness()
    {
        $wellness = Wellness::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'orientacion_psicologia' => $this->faker->randomNumber(2),
            'actividades_deportivas' => $this->faker->randomNumber(2),
            'actividades_culturales' => $this->faker->randomNumber(2),
            'plan_covid19' => $this->faker->randomNumber(2),
            'felicidad_entorno' => $this->faker->randomNumber(2),
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->putJson(
            route('api.wellnesses.update', $wellness),
            $data
        );

        $data['id'] = $wellness->id;

        $this->assertDatabaseHas('wellnesses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wellness()
    {
        $wellness = Wellness::factory()->create();

        $response = $this->deleteJson(
            route('api.wellnesses.destroy', $wellness)
        );

        $this->assertModelMissing($wellness);

        $response->assertNoContent();
    }
}
