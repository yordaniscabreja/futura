<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Zone;
use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicProgramZonesTest extends TestCase
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
    public function it_gets_academic_program_zones()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $zones = Zone::factory()
            ->count(2)
            ->create([
                'academic_program_id' => $academicProgram->id,
            ]);

        $response = $this->getJson(
            route('api.academic-programs.zones.index', $academicProgram)
        );

        $response->assertOk()->assertSee($zones[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_program_zones()
    {
        $academicProgram = AcademicProgram::factory()->create();
        $data = Zone::factory()
            ->make([
                'academic_program_id' => $academicProgram->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.academic-programs.zones.store', $academicProgram),
            $data
        );

        $this->assertDatabaseHas('zones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $zone = Zone::latest('id')->first();

        $this->assertEquals($academicProgram->id, $zone->academic_program_id);
    }
}
