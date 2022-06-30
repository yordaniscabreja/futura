<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Modality;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModalityAcademicProgramsTest extends TestCase
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
    public function it_gets_modality_academic_programs()
    {
        $modality = Modality::factory()->create();
        $academicPrograms = AcademicProgram::factory()
            ->count(2)
            ->create([
                'modality_id' => $modality->id,
            ]);

        $response = $this->getJson(
            route('api.modalities.academic-programs.index', $modality)
        );

        $response->assertOk()->assertSee($academicPrograms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_modality_academic_programs()
    {
        $modality = Modality::factory()->create();
        $data = AcademicProgram::factory()
            ->make([
                'modality_id' => $modality->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.modalities.academic-programs.store', $modality),
            $data
        );

        $this->assertDatabaseHas('academic_programs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $academicProgram = AcademicProgram::latest('id')->first();

        $this->assertEquals($modality->id, $academicProgram->modality_id);
    }
}
