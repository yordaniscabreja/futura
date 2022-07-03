<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Prestige;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramPrestigesTest extends TestCase
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
    public function it_gets_academic_program_prestiges()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $prestiges = Prestige::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.prestiges.index', $academicProgram)
        );

        $response->assertOk()->assertSee($prestiges[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_prestiges()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Prestige::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.prestiges.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('prestiges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $prestige = Prestige::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $prestige->academic_program_id
        );
    }
}
