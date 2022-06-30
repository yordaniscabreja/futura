<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\LifeStyle;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LifeStyleControllerTest extends TestCase
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
    public function it_displays_index_view_with_life_styles()
    {
        $lifeStyles = LifeStyle::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('life-styles.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.life_styles.index')
            ->assertViewHas('lifeStyles');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_life_style()
    {
        $response = $this->get(route('life-styles.create'));

        $response->assertOk()->assertViewIs('app.life_styles.create');
    }

    /**
     * @test
     */
    public function it_stores_the_life_style()
    {
        $data = LifeStyle::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('life-styles.store'), $data);

        $this->assertDatabaseHas('life_styles', $data);

        $lifeStyle = LifeStyle::latest('id')->first();

        $response->assertRedirect(route('life-styles.edit', $lifeStyle));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_life_style()
    {
        $lifeStyle = LifeStyle::factory()->create();

        $response = $this->get(route('life-styles.show', $lifeStyle));

        $response
            ->assertOk()
            ->assertViewIs('app.life_styles.show')
            ->assertViewHas('lifeStyle');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_life_style()
    {
        $lifeStyle = LifeStyle::factory()->create();

        $response = $this->get(route('life-styles.edit', $lifeStyle));

        $response
            ->assertOk()
            ->assertViewIs('app.life_styles.edit')
            ->assertViewHas('lifeStyle');
    }

    /**
     * @test
     */
    public function it_updates_the_life_style()
    {
        $lifeStyle = LifeStyle::factory()->create();

        $university = University::factory()->create();

        $data = [
            'ambiente' => $this->faker->randomNumber(2),
            'diversion_ocio' => $this->faker->randomNumber(2),
            'descanso_relax' => $this->faker->randomNumber(2),
            'cultura_ecologica' => $this->faker->randomNumber(2),
            'servicio_estudiante' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->put(route('life-styles.update', $lifeStyle), $data);

        $data['id'] = $lifeStyle->id;

        $this->assertDatabaseHas('life_styles', $data);

        $response->assertRedirect(route('life-styles.edit', $lifeStyle));
    }

    /**
     * @test
     */
    public function it_deletes_the_life_style()
    {
        $lifeStyle = LifeStyle::factory()->create();

        $response = $this->delete(route('life-styles.destroy', $lifeStyle));

        $response->assertRedirect(route('life-styles.index'));

        $this->assertModelMissing($lifeStyle);
    }
}
