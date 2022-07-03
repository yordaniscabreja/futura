<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\LifeStyle;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramLifeStylesTest extends TestCase
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
    public function it_gets_academic_program_life_styles()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $lifeStyles = LifeStyle::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.life-styles.index', $academicProgram)
        );

        $response->assertOk()->assertSee($lifeStyles[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_life_styles()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = LifeStyle::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.life-styles.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('life_styles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $lifeStyle = LifeStyle::latest('id')->first();

        $this->assertEquals(
            $academicProgram->id,
            $lifeStyle->academic_program_id
        );
    }
}
