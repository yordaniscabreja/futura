<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Bond;

use App\Models\AcademicProgram;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BondControllerTest extends TestCase
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
    public function it_displays_index_view_with_bonds()
    {
        $bonds = Bond::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bonds.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bonds.index')
            ->assertViewHas('bonds');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bond()
    {
        $response = $this->get(route('bonds.create'));

        $response->assertOk()->assertViewIs('app.bonds.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bond()
    {
        $data = Bond::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bonds.store'), $data);

        $this->assertDatabaseHas('bonds', $data);

        $bond = Bond::latest('id')->first();

        $response->assertRedirect(route('bonds.edit', $bond));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bond()
    {
        $bond = Bond::factory()->create();

        $response = $this->get(route('bonds.show', $bond));

        $response
            ->assertOk()
            ->assertViewIs('app.bonds.show')
            ->assertViewHas('bond');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bond()
    {
        $bond = Bond::factory()->create();

        $response = $this->get(route('bonds.edit', $bond));

        $response
            ->assertOk()
            ->assertViewIs('app.bonds.edit')
            ->assertViewHas('bond');
    }

    /**
     * @test
     */
    public function it_updates_the_bond()
    {
        $bond = Bond::factory()->create();

        $academicProgram = AcademicProgram::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'academic_program_id' => $academicProgram->id,
        ];

        $response = $this->put(route('bonds.update', $bond), $data);

        $data['id'] = $bond->id;

        $this->assertDatabaseHas('bonds', $data);

        $response->assertRedirect(route('bonds.edit', $bond));
    }

    /**
     * @test
     */
    public function it_deletes_the_bond()
    {
        $bond = Bond::factory()->create();

        $response = $this->delete(route('bonds.destroy', $bond));

        $response->assertRedirect(route('bonds.index'));

        $this->assertModelMissing($bond);
    }
}
