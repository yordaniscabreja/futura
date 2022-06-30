<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BasicCore;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicCoreAcademicProgramsTest extends TestCase
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
    public function it_gets_basic_core_academic_programs()
    {
        $basicCore = BasicCore::factory()->create();
        $academicPrograms = AcademicProgram::factory()
            ->count(2)
            ->create([
                'basic_core_id' => $basicCore->id,
            ]);

        $response = $this->getJson(
            route('api.basic-cores.academic-programs.index', $basicCore)
        );

        $response->assertOk()->assertSee($academicPrograms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_basic_core_academic_programs()
    {
        $basicCore = BasicCore::factory()->create();
        $data = AcademicProgram::factory()
            ->make([
                'basic_core_id' => $basicCore->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.basic-cores.academic-programs.store', $basicCore),
            $data
        );

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academicProgram = AcademicProgram::latest('id')->first();

        $this->assertEquals($basicCore->id, $academicProgram->basic_core_id);
    }
}
