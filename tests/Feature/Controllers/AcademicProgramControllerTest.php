<?php

namespace Tests\Feature\Controllers;

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

class AcademicProgramControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_academic_programs()
    {
        $academicPrograms = AcademicProgram::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('academic-programs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_programs.index')
            ->assertViewHas('academicPrograms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_academic_program()
    {
        $response = $this->get(route('academic-programs.create'));

        $response->assertOk()->assertViewIs('app.academic_programs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program()
    {
        $data = AcademicProgram::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('academic-programs.store'), $data);

        $this->assertDatabaseHas('academic_programs', $data);

        $academicProgram = AcademicProgram::latest('id')->first();

        $response->assertRedirect(
            route('academic-programs.edit', $academicProgram)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_academic_program()
    {
        $academicProgram = AcademicProgram::factory()->create();

        $response = $this->get(
            route('academic-programs.show', $academicProgram)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.academic_programs.show')
            ->assertViewHas('academicProgram');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_academic_program()
    {
        $academicProgram = AcademicProgram::factory()->create();

        $response = $this->get(
            route('academic-programs.edit', $academicProgram)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.academic_programs.edit')
            ->assertViewHas('academicProgram');
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

        $response = $this->put(
            route('academic-programs.update', $academicProgram),
            $data
        );

        $data['id'] = $academicProgram->id;

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertRedirect(
            route('academic-programs.edit', $academicProgram)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_academic_program()
    {
        $academicProgram = AcademicProgram::factory()->create();

        $response = $this->delete(
            route('academic-programs.destroy', $academicProgram)
        );

        $response->assertRedirect(route('academic-programs.index'));

        $this->assertModelMissing($academicProgram);
    }
}
