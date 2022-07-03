<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Campus;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramCampusesTest extends TestCase
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
    public function it_gets_academic_program_campuses()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $campuses = Campus::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.campuses.index', $academicProgram)
        );

        $response->assertOk()->assertSee($campuses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_campuses()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Campus::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.campuses.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('campuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $campus = Campus::latest('id')->first();

        $this->assertEquals($academicProgram->id, $campus->academic_program_id);
    }
}
