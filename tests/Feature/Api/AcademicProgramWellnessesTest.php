<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Wellness;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramWellnessesTest extends TestCase
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
    public function it_gets_academic_program_wellnesses()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $wellnesses = Wellness::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.wellnesses.index', $academicProgram)
        );

        $response->assertOk()->assertSee($wellnesses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_wellnesses()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Wellness::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.wellnesses.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('wellnesses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $wellness = Wellness::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $wellness->academic_program_id
        );
    }
}
