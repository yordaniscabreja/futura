<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AcademicProgram;
use App\Models\Internalization;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramInternalizationsTest extends TestCase
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
    public function it_gets_academic_program_internalizations()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $internalizations = Internalization::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route(
                'api.academic-programs.internalizations.index',
                $academicProgram
            )
        );

        $response->assertOk()->assertSee($internalizations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_internalizations()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Internalization::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.academic-programs.internalizations.store',
                $academicProgram
            ),
            $data
        );

        $this->assertDatabaseHas('internalizations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $internalization = Internalization::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $internalization->academic_program_id
        );
    }
}
