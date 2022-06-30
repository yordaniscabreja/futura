<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\University;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityAcademicProgramsTest extends TestCase
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
    public function it_gets_university_academic_programs()
    {
        $university = University::factory()->create();
        $academicPrograms = AcademicProgram::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.academic-programs.index', $university)
        );

        $response->assertOk()->assertSee($academicPrograms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_university_academic_programs()
    {
        $university = University::factory()->create();
        $data = AcademicProgram::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.academic-programs.store', $university),
            $data
        );

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academicProgram = AcademicProgram::latest('id')->first();

        $this->assertEquals($university->id, $academicProgram->university_id);
    }
}
