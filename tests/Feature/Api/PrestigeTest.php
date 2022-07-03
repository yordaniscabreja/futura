<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prestige;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrestigeTest extends TestCase
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
    public function it_gets_prestiges_list()
    {
        $prestiges = Prestige::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.prestiges.index'));

        $response->assertOk()->assertSee($prestiges[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_prestige()
    {
        $data = Prestige::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.prestiges.store'), $data);

        $this->assertDatabaseHas('prestiges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_prestige()
    {
        $prestige = Prestige::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'reputacion_institucional' => $this->faker->randomNumber(2),
            'practicas_profesionales' => $this->faker->randomNumber(2),
            'imagen_egresado' => $this->faker->randomNumber(2),
            'asociaciones_externas' => $this->faker->randomNumber(2),
            'bolsa_empleo' => $this->faker->randomNumber(2),
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->putJson(
            route('api.prestiges.update', $prestige),
            $data
        );

        $data['id'] = $prestige->id;

        $this->assertDatabaseHas('prestiges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_prestige()
    {
        $prestige = Prestige::factory()->create();

        $response = $this->deleteJson(
            route('api.prestiges.destroy', $prestige)
        );

        $this->assertModelMissing($prestige);

        $response->assertNoContent();
    }
}
