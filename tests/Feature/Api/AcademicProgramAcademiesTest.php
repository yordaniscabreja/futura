<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Academy;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramAcademiesTest extends TestCase
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
    public function it_gets_academic_program_academies()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $academies = Academy::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.academies.index', $academicProgram)
        );

        $response->assertOk()->assertSee($academies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_academies()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Academy::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.academies.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('academies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academy = Academy::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $academy->academic_program_id
        );
    }
}
