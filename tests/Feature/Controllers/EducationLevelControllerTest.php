<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\EducationLevel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EducationLevelControllerTest extends TestCase
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
    public function it_displays_index_view_with_education_levels()
    {
        $educationLevels = EducationLevel::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('education-levels.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.education_levels.index')
            ->assertViewHas('educationLevels');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_education_level()
    {
        $response = $this->get(route('education-levels.create'));

        $response->assertOk()->assertViewIs('app.education_levels.create');
    }

    /**
     * @test
     */
    public function it_stores_the_education_level()
    {
        $data = EducationLevel::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('education-levels.store'), $data);

        $this->assertDatabaseHas('education_levels', $data);

        $educationLevel = EducationLevel::latest('id')->first();

        $response->assertRedirect(
            route('education-levels.edit', $educationLevel)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_education_level()
    {
        $educationLevel = EducationLevel::factory()->create();

        $response = $this->get(route('education-levels.show', $educationLevel));

        $response
            ->assertOk()
            ->assertViewIs('app.education_levels.show')
            ->assertViewHas('educationLevel');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_education_level()
    {
        $educationLevel = EducationLevel::factory()->create();

        $response = $this->get(route('education-levels.edit', $educationLevel));

        $response
            ->assertOk()
            ->assertViewIs('app.education_levels.edit')
            ->assertViewHas('educationLevel');
    }

    /**
     * @test
     */
    public function it_updates_the_education_level()
    {
        $educationLevel = EducationLevel::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('education-levels.update', $educationLevel),
            $data
        );

        $data['id'] = $educationLevel->id;

        $this->assertDatabaseHas('education_levels', $data);

        $response->assertRedirect(
            route('education-levels.edit', $educationLevel)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_education_level()
    {
        $educationLevel = EducationLevel::factory()->create();

        $response = $this->delete(
            route('education-levels.destroy', $educationLevel)
        );

        $response->assertRedirect(route('education-levels.index'));

        $this->assertModelMissing($educationLevel);
    }
}
