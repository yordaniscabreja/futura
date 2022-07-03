<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Economy;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramEconomiesTest extends TestCase
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
    public function it_gets_academic_program_economies()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $economies = Economy::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.economies.index', $academicProgram)
        );

        $response->assertOk()->assertSee($economies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_economies()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Economy::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.economies.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('economies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $economy = Economy::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $economy->academic_program_id
        );
    }
}
