<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AcademicProgram;

use App\Models\Modality;
use App\Models\BasicCore;
use App\Models\University;
use App\Models\AcademicLevel;
use App\Models\EducationLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramTest extends TestCase
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
    public function it_gets_academic_programs_list()
    {
        $academicPrograms = AcademicProgram::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.academic-programs.index'));

        $response->assertOk()->assertSee($academicPrograms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program()
    {
        $data = AcademicProgram::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.store'),
            $data
        );

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_academic_program()
    {
        $academicProgram = AcademicProgram::factory()->create();

        $university = University::factory()->create();
        $basicCore = BasicCore::factory()->create();
        $academicLevel = AcademicLevel::factory()->create();
        $modality = Modality::factory()->create();
        $educationLevel = EducationLevel::factory()->create();

        $data = [
            'name' => $this->faker->text,
            'snies_code' => $this->faker->text(255),
            'acreditado' => $this->faker->boolean,
            'credits' => $this->faker->randomNumber(0),
            'numero_duracion' => $this->faker->randomNumber(0),
            'periodo_duracion' => $this->faker->text(255),
            'jornada' => $this->faker->text(255),
            'precio' => $this->faker->text(255),
            'university_id' => $university->id,
            'basic_core_id' => $basicCore->id,
            'academic_level_id' => $academicLevel->id,
            'modality_id' => $modality->id,
            'education_level_id' => $educationLevel->id,
        ];

        $response = $this->putJson(
            route('api.academic-programs.update', $academicProgram),
            $data
        );

        $data['id'] = $academicProgram->id;

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_academic_program()
    {
        $academicProgram = AcademicProgram::factory()->create();

        $response = $this->deleteJson(
            route('api.academic-programs.destroy', $academicProgram)
        );

        $this->assertModelMissing($academicProgram);

        $response->assertNoContent();
    }
}
