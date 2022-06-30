<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AcademicLevel;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicLevelAcademicProgramsTest extends TestCase
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
    public function it_gets_academic_level_academic_programs()
    {
        $academicLevel = AcademicLevel::factory()->create();
        $academicPrograms = AcademicProgram::factory()
            ->count(2)
            ->create([
                'academic_level_id' => $academicLevel->id,
            ]);

        $response = $this->getJson(
            route('api.academic-levels.academic-programs.index', $academicLevel)
        );

        $response->assertOk()->assertSee($academicPrograms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_level_academic_programs()
    {
        $academicLevel = AcademicLevel::factory()->create();
        $data = AcademicProgram::factory()
            ->make([
                'academic_level_id' => $academicLevel->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.academic-levels.academic-programs.store',
                $academicLevel
            ),
            $data
        );

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academicProgram = AcademicProgram::latest('id')->first();

        $this->assertEquals(
            $academicLevel->id,
            $academicProgram->academic_level_id
        );
    }
}
