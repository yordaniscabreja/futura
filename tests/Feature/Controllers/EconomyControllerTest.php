<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Economy;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EconomyControllerTest extends TestCase
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
    public function it_displays_index_view_with_economies()
    {
        $economies = Economy::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('economies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.economies.index')
            ->assertViewHas('economies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_economy()
    {
        $response = $this->get(route('economies.create'));

        $response->assertOk()->assertViewIs('app.economies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_economy()
    {
        $data = Economy::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('economies.store'), $data);

        $this->assertDatabaseHas('economies', $data);

        $economy = Economy::latest('id')->first();

        $response->assertRedirect(route('economies.edit', $economy));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_economy()
    {
        $economy = Economy::factory()->create();

        $response = $this->get(route('economies.show', $economy));

        $response
            ->assertOk()
            ->assertViewIs('app.economies.show')
            ->assertViewHas('economy');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_economy()
    {
        $economy = Economy::factory()->create();

        $response = $this->get(route('economies.edit', $economy));

        $response
            ->assertOk()
            ->assertViewIs('app.economies.edit')
            ->assertViewHas('economy');
    }

    /**
     * @test
     */
    public function it_updates_the_economy()
    {
        $economy = Economy::factory()->create();

        $university = University::factory()->create();

        $data = [
            'financiacion' => $this->faker->randomNumber(2),
            'becas_auxilio' => $this->faker->randomNumber(2),
            'costos_calidad' => $this->faker->randomNumber(2),
            'costos_manutencion' => $this->faker->randomNumber(2),
            'costos_parqueadero' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->put(route('economies.update', $economy), $data);

        $data['id'] = $economy->id;

        $this->assertDatabaseHas('economies', $data);

        $response->assertRedirect(route('economies.edit', $economy));
    }

    /**
     * @test
     */
    public function it_deletes_the_economy()
    {
        $economy = Economy::factory()->create();

        $response = $this->delete(route('economies.destroy', $economy));

        $response->assertRedirect(route('economies.index'));

        $this->assertModelMissing($economy);
    }
}
