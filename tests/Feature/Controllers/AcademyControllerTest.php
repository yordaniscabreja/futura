<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Academy;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademyControllerTest extends TestCase
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
    public function it_displays_index_view_with_academies()
    {
        $academies = Academy::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('academies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.academies.index')
            ->assertViewHas('academies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_academy()
    {
        $response = $this->get(route('academies.create'));

        $response->assertOk()->assertViewIs('app.academies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_academy()
    {
        $data = Academy::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('academies.store'), $data);

        $this->assertDatabaseHas('academies', $data);

        $academy = Academy::latest('id')->first();

        $response->assertRedirect(route('academies.edit', $academy));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_academy()
    {
        $academy = Academy::factory()->create();

        $response = $this->get(route('academies.show', $academy));

        $response
            ->assertOk()
            ->assertViewIs('app.academies.show')
            ->assertViewHas('academy');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_academy()
    {
        $academy = Academy::factory()->create();

        $response = $this->get(route('academies.edit', $academy));

        $response
            ->assertOk()
            ->assertViewIs('app.academies.edit')
            ->assertViewHas('academy');
    }

    /**
     * @test
     */
    public function it_updates_the_academy()
    {
        $academy = Academy::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'plan_estudio' => $this->faker->randomNumber(2),
            'recursos_academicos' => $this->faker->randomNumber(2),
            'tecnologia' => $this->faker->randomNumber(2),
            'tamano_grupos' => $this->faker->randomNumber(2),
            'excelencia_profesores' => $this->faker->randomNumber(2),
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->put(route('academies.update', $academy), $data);

        $data['id'] = $academy->id;

        $this->assertDatabaseHas('academies', $data);

        $response->assertRedirect(route('academies.edit', $academy));
    }

    /**
     * @test
     */
    public function it_deletes_the_academy()
    {
        $academy = Academy::factory()->create();

        $response = $this->delete(route('academies.destroy', $academy));

        $response->assertRedirect(route('academies.index'));

        $this->assertModelMissing($academy);
    }
}
