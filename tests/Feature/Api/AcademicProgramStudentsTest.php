<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Student;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramStudentsTest extends TestCase
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
    public function it_gets_academic_program_students()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $students = Student::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.students.index', $academicProgram)
        );

        $response->assertOk()->assertSee($students[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_students()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Student::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.students.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('students', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $student = Student::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $student->academic_program_id
        );
    }
}
