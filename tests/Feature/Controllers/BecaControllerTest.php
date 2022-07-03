<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Beca;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BecaControllerTest extends TestCase
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
    public function it_displays_index_view_with_becas()
    {
        $becas = Beca::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('becas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.becas.index')
            ->assertViewHas('becas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_beca()
    {
        $response = $this->get(route('becas.create'));

        $response->assertOk()->assertViewIs('app.becas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_beca()
    {
        $data = Beca::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('becas.store'), $data);

        $this->assertDatabaseHas('becas', $data);

        $beca = Beca::latest('id')->first();

        $response->assertRedirect(route('becas.edit', $beca));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_beca()
    {
        $beca = Beca::factory()->create();

        $response = $this->get(route('becas.show', $beca));

        $response
            ->assertOk()
            ->assertViewIs('app.becas.show')
            ->assertViewHas('beca');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_beca()
    {
        $beca = Beca::factory()->create();

        $response = $this->get(route('becas.edit', $beca));

        $response
            ->assertOk()
            ->assertViewIs('app.becas.edit')
            ->assertViewHas('beca');
    }

    /**
     * @test
     */
    public function it_updates_the_beca()
    {
        $beca = Beca::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->put(route('becas.update', $beca), $data);

        $data['id'] = $beca->id;

        $this->assertDatabaseHas('becas', $data);

        $response->assertRedirect(route('becas.edit', $beca));
    }

    /**
     * @test
     */
    public function it_deletes_the_beca()
    {
        $beca = Beca::factory()->create();

        $response = $this->delete(route('becas.destroy', $beca));

        $response->assertRedirect(route('becas.index'));

        $this->assertModelMissing($beca);
    }
}
