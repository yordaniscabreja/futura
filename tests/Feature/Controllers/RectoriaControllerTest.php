<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Rectoria;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RectoriaControllerTest extends TestCase
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
    public function it_displays_index_view_with_rectorias()
    {
        $rectorias = Rectoria::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('rectorias.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.rectorias.index')
            ->assertViewHas('rectorias');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_rectoria()
    {
        $response = $this->get(route('rectorias.create'));

        $response->assertOk()->assertViewIs('app.rectorias.create');
    }

    /**
     * @test
     */
    public function it_stores_the_rectoria()
    {
        $data = Rectoria::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('rectorias.store'), $data);

        $this->assertDatabaseHas('rectorias', $data);

        $rectoria = Rectoria::latest('id')->first();

        $response->assertRedirect(route('rectorias.edit', $rectoria));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_rectoria()
    {
        $rectoria = Rectoria::factory()->create();

        $response = $this->get(route('rectorias.show', $rectoria));

        $response
            ->assertOk()
            ->assertViewIs('app.rectorias.show')
            ->assertViewHas('rectoria');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_rectoria()
    {
        $rectoria = Rectoria::factory()->create();

        $response = $this->get(route('rectorias.edit', $rectoria));

        $response
            ->assertOk()
            ->assertViewIs('app.rectorias.edit')
            ->assertViewHas('rectoria');
    }

    /**
     * @test
     */
    public function it_updates_the_rectoria()
    {
        $rectoria = Rectoria::factory()->create();

        $university = University::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'position' => $this->faker->text(255),
            'image' => $this->faker->text(255),
            'last_name' => $this->faker->lastName,
            'university_id' => $university->id,
        ];

        $response = $this->put(route('rectorias.update', $rectoria), $data);

        $data['id'] = $rectoria->id;

        $this->assertDatabaseHas('rectorias', $data);

        $response->assertRedirect(route('rectorias.edit', $rectoria));
    }

    /**
     * @test
     */
    public function it_deletes_the_rectoria()
    {
        $rectoria = Rectoria::factory()->create();

        $response = $this->delete(route('rectorias.destroy', $rectoria));

        $response->assertRedirect(route('rectorias.index'));

        $this->assertModelMissing($rectoria);
    }
}
