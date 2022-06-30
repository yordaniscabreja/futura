<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\EducationLevel;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EducationLevelAcademicProgramsTest extends TestCase
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
    public function it_gets_education_level_academic_programs()
    {
        $educationLevel = EducationLevel::factory()->create();
        $academicPrograms = AcademicProgram::factory()
            ->count(2)
            ->create([
                'education_level_id' => $educationLevel->id,
            ]);

        $response = $this->getJson(
            route(
                'api.education-levels.academic-programs.index',
                $educationLevel
            )
        );

        $response->assertOk()->assertSee($academicPrograms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_education_level_academic_programs()
    {
        $educationLevel = EducationLevel::factory()->create();
        $data = AcademicProgram::factory()
            ->make([
                'education_level_id' => $educationLevel->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.education-levels.academic-programs.store',
                $educationLevel
            ),
            $data
        );

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academicProgram = AcademicProgram::latest('id')->first();

        $this->assertEquals(
            $educationLevel->id,
            $academicProgram->education_level_id
        );
    }
}
