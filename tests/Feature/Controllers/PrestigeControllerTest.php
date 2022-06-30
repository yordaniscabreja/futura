<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Prestige;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrestigeControllerTest extends TestCase
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
    public function it_displays_index_view_with_prestiges()
    {
        $prestiges = Prestige::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('prestiges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.prestiges.index')
            ->assertViewHas('prestiges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_prestige()
    {
        $response = $this->get(route('prestiges.create'));

        $response->assertOk()->assertViewIs('app.prestiges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_prestige()
    {
        $data = Prestige::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('prestiges.store'), $data);

        $this->assertDatabaseHas('prestiges', $data);

        $prestige = Prestige::latest('id')->first();

        $response->assertRedirect(route('prestiges.edit', $prestige));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_prestige()
    {
        $prestige = Prestige::factory()->create();

        $response = $this->get(route('prestiges.show', $prestige));

        $response
            ->assertOk()
            ->assertViewIs('app.prestiges.show')
            ->assertViewHas('prestige');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_prestige()
    {
        $prestige = Prestige::factory()->create();

        $response = $this->get(route('prestiges.edit', $prestige));

        $response
            ->assertOk()
            ->assertViewIs('app.prestiges.edit')
            ->assertViewHas('prestige');
    }

    /**
     * @test
     */
    public function it_updates_the_prestige()
    {
        $prestige = Prestige::factory()->create();

        $university = University::factory()->create();

        $data = [
            'reputacion_institucional' => $this->faker->randomNumber(2),
            'practicas_profesionales' => $this->faker->randomNumber(2),
            'imagen_egresado' => $this->faker->randomNumber(2),
            'asociaciones_externas' => $this->faker->randomNumber(2),
            'bolsa_empleo' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->put(route('prestiges.update', $prestige), $data);

        $data['id'] = $prestige->id;

        $this->assertDatabaseHas('prestiges', $data);

        $response->assertRedirect(route('prestiges.edit', $prestige));
    }

    /**
     * @test
     */
    public function it_deletes_the_prestige()
    {
        $prestige = Prestige::factory()->create();

        $response = $this->delete(route('prestiges.destroy', $prestige));

        $response->assertRedirect(route('prestiges.index'));

        $this->assertModelMissing($prestige);
    }
}
