<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AcademicLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademicLevelControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_academic_levels()
    {
        $academicLevels = AcademicLevel::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('academic-levels.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_levels.index')
            ->assertViewHas('academicLevels');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_academic_level()
    {
        $response = $this->get(route('academic-levels.create'));

        $response->assertOk()->assertViewIs('app.academic_levels.create');
    }

    /**
     * @test
     */
    public function it_stores_the_academic_level()
    {
        $data = AcademicLevel::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('academic-levels.store'), $data);

        $this->assertDatabaseHas('academic_levels', $data);

        $academicLevel = AcademicLevel::latest('id')->first();

        $response->assertRedirect(
            route('academic-levels.edit', $academicLevel)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_academic_level()
    {
        $academicLevel = AcademicLevel::factory()->create();

        $response = $this->get(route('academic-levels.show', $academicLevel));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_levels.show')
            ->assertViewHas('academicLevel');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_academic_level()
    {
        $academicLevel = AcademicLevel::factory()->create();

        $response = $this->get(route('academic-levels.edit', $academicLevel));

        $response
            ->assertOk()
            ->assertViewIs('app.academic_levels.edit')
            ->assertViewHas('academicLevel');
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

        $response = $this->put(
            route('academic-levels.update', $academicLevel),
            $data
        );

        $data['id'] = $academicLevel->id;

        $this->assertDatabaseHas('academic_levels', $data);

        $response->assertRedirect(
            route('academic-levels.edit', $academicLevel)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_academic_level()
    {
        $academicLevel = AcademicLevel::factory()->create();

        $response = $this->delete(
            route('academic-levels.destroy', $academicLevel)
        );

        $response->assertRedirect(route('academic-levels.index'));

        $this->assertModelMissing($academicLevel);
    }
}
