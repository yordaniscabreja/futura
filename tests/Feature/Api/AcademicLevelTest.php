<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AcademicLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicLevelTest extends TestCase
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
    public function it_gets_academic_levels_list()
    {
        $academicLevels = AcademicLevel::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.academic-levels.index'));

        $response->assertOk()->assertSee($academicLevels[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_academic_level()
    {
        $data = AcademicLevel::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.academic-levels.store'), $data);

        $this->assertDatabaseHas('academic_levels', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_academic_level()
    {
        $academicLevel = AcademicLevel::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.academic-levels.update', $academicLevel),
            $data
        );

        $data['id'] = $academicLevel->id;

        $this->assertDatabaseHas('academic_levels', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_academic_level()
    {
        $academicLevel = AcademicLevel::factory()->create();

        $response = $this->deleteJson(
            route('api.academic-levels.destroy', $academicLevel)
        );

        $this->assertModelMissing($academicLevel);

        $response->assertNoContent();
    }
}
