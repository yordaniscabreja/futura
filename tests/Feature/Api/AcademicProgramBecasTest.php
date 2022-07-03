<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Beca;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramBecasTest extends TestCase
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
    public function it_gets_academic_program_becas()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $becas = Beca::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.becas.index', $academicProgram)
        );

        $response->assertOk()->assertSee($becas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_becas()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Beca::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.becas.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('becas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $beca = Beca::latest('id')->first();

        $this->assertEquals($academicProgram->id, $beca->academic_program_id);
    }
}
