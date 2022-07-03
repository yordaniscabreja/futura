<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Economy;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EconomyTest extends TestCase
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
    public function it_gets_economies_list()
    {
        $economies = Economy::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.economies.index'));

        $response->assertOk()->assertSee($economies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_economy()
    {
        $data = Economy::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.economies.store'), $data);

        $this->assertDatabaseHas('economies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_economy()
    {
        $economy = Economy::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'financiacion' => $this->faker->randomNumber(2),
            'becas_auxilio' => $this->faker->randomNumber(2),
            'costos_calidad' => $this->faker->randomNumber(2),
            'costos_manutencion' => $this->faker->randomNumber(2),
            'costos_parqueadero' => $this->faker->randomNumber(2),
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->putJson(
            route('api.economies.update', $economy),
            $data
        );

        $data['id'] = $economy->id;

        $this->assertDatabaseHas('economies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_economy()
    {
        $economy = Economy::factory()->create();

        $response = $this->deleteJson(route('api.economies.destroy', $economy));

        $this->assertModelMissing($economy);

        $response->assertNoContent();
    }
}
