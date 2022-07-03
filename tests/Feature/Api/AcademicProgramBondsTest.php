<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bond;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramBondsTest extends TestCase
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
    public function it_gets_academic_program_bonds()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $bonds = Bond::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.bonds.index', $academicProgram)
        );

        $response->assertOk()->assertSee($bonds[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_bonds()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Bond::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.bonds.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('bonds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bond = Bond::latest('id')->first();

        $this->assertEquals($academicProgram->id, $bond->academic_program_id);
    }
}
