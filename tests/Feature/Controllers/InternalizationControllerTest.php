<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Internalization;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InternalizationControllerTest extends TestCase
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
    public function it_displays_index_view_with_internalizations()
    {
        $internalizations = Internalization::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('internalizations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.internalizations.index')
            ->assertViewHas('internalizations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_internalization()
    {
        $response = $this->get(route('internalizations.create'));

        $response->assertOk()->assertViewIs('app.internalizations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_internalization()
    {
        $data = Internalization::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('internalizations.store'), $data);

        $this->assertDatabaseHas('internalizations', $data);

        $internalization = Internalization::latest('id')->first();

        $response->assertRedirect(
            route('internalizations.edit', $internalization)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_internalization()
    {
        $internalization = Internalization::factory()->create();

        $response = $this->get(
            route('internalizations.show', $internalization)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.internalizations.show')
            ->assertViewHas('internalization');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_internalization()
    {
        $internalization = Internalization::factory()->create();

        $response = $this->get(
            route('internalizations.edit', $internalization)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.internalizations.edit')
            ->assertViewHas('internalization');
    }

    /**
     * @test
     */
    public function it_updates_the_internalization()
    {
        $internalization = Internalization::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'intercambios_movilidad' => $this->faker->randomNumber(2),
            'facilidad_acceso' => $this->faker->randomNumber(2),
            'relevancia_internacional' => $this->faker->randomNumber(2),
            'convenios_internacionales' => $this->faker->randomNumber(2),
            'segundo_idioma' => $this->faker->randomNumber(2),
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->put(
            route('internalizations.update', $internalization),
            $data
        );

        $data['id'] = $internalization->id;

        $this->assertDatabaseHas('internalizations', $data);

        $response->assertRedirect(
            route('internalizations.edit', $internalization)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_internalization()
    {
        $internalization = Internalization::factory()->create();

        $response = $this->delete(
            route('internalizations.destroy', $internalization)
        );

        $response->assertRedirect(route('internalizations.index'));

        $this->assertModelMissing($internalization);
    }
}
