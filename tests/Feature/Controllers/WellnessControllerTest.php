<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Wellness;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WellnessControllerTest extends TestCase
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
    public function it_displays_index_view_with_wellnesses()
    {
        $wellnesses = Wellness::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wellnesses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wellnesses.index')
            ->assertViewHas('wellnesses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wellness()
    {
        $response = $this->get(route('wellnesses.create'));

        $response->assertOk()->assertViewIs('app.wellnesses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wellness()
    {
        $data = Wellness::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wellnesses.store'), $data);

        $this->assertDatabaseHas('wellnesses', $data);

        $wellness = Wellness::latest('id')->first();

        $response->assertRedirect(route('wellnesses.edit', $wellness));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wellness()
    {
        $wellness = Wellness::factory()->create();

        $response = $this->get(route('wellnesses.show', $wellness));

        $response
            ->assertOk()
            ->assertViewIs('app.wellnesses.show')
            ->assertViewHas('wellness');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wellness()
    {
        $wellness = Wellness::factory()->create();

        $response = $this->get(route('wellnesses.edit', $wellness));

        $response
            ->assertOk()
            ->assertViewIs('app.wellnesses.edit')
            ->assertViewHas('wellness');
    }

    /**
     * @test
     */
    public function it_updates_the_wellness()
    {
        $wellness = Wellness::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'orientacion_psicologia' => $this->faker->randomNumber(2),
            'actividades_deportivas' => $this->faker->randomNumber(2),
            'actividades_culturales' => $this->faker->randomNumber(2),
            'plan_covid19' => $this->faker->randomNumber(2),
            'felicidad_entorno' => $this->faker->randomNumber(2),
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->put(route('wellnesses.update', $wellness), $data);

        $data['id'] = $wellness->id;

        $this->assertDatabaseHas('wellnesses', $data);

        $response->assertRedirect(route('wellnesses.edit', $wellness));
    }

    /**
     * @test
     */
    public function it_deletes_the_wellness()
    {
        $wellness = Wellness::factory()->create();

        $response = $this->delete(route('wellnesses.destroy', $wellness));

        $response->assertRedirect(route('wellnesses.index'));

        $this->assertModelMissing($wellness);
    }
}
