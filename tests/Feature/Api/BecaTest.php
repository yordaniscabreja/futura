<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Beca;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BecaTest extends TestCase
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
    public function it_gets_becas_list()
    {
        $becas = Beca::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.becas.index'));

        $response->assertOk()->assertSee($becas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_beca()
    {
        $data = Beca::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.becas.store'), $data);

        $this->assertDatabaseHas('becas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_beca()
    {
        $beca = Beca::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->putJson(route('api.becas.update', $beca), $data);

        $data['id'] = $beca->id;

        $this->assertDatabaseHas('becas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_beca()
    {
        $beca = Beca::factory()->create();

        $response = $this->deleteJson(route('api.becas.destroy', $beca));

        $this->assertModelMissing($beca);

        $response->assertNoContent();
    }
}
