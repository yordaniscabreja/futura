<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Requeriment;

use App\Models\Beca;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequerimentControllerTest extends TestCase
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
    public function it_displays_index_view_with_requeriments()
    {
        $requeriments = Requeriment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('requeriments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.requeriments.index')
            ->assertViewHas('requeriments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_requeriment()
    {
        $response = $this->get(route('requeriments.create'));

        $response->assertOk()->assertViewIs('app.requeriments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_requeriment()
    {
        $data = Requeriment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('requeriments.store'), $data);

        $this->assertDatabaseHas('requeriments', $data);

        $requeriment = Requeriment::latest('id')->first();

        $response->assertRedirect(route('requeriments.edit', $requeriment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_requeriment()
    {
        $requeriment = Requeriment::factory()->create();

        $response = $this->get(route('requeriments.show', $requeriment));

        $response
            ->assertOk()
            ->assertViewIs('app.requeriments.show')
            ->assertViewHas('requeriment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_requeriment()
    {
        $requeriment = Requeriment::factory()->create();

        $response = $this->get(route('requeriments.edit', $requeriment));

        $response
            ->assertOk()
            ->assertViewIs('app.requeriments.edit')
            ->assertViewHas('requeriment');
    }

    /**
     * @test
     */
    public function it_updates_the_requeriment()
    {
        $requeriment = Requeriment::factory()->create();

        $beca = Beca::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'beca_id' => $beca->id,
        ];

        $response = $this->put(
            route('requeriments.update', $requeriment),
            $data
        );

        $data['id'] = $requeriment->id;

        $this->assertDatabaseHas('requeriments', $data);

        $response->assertRedirect(route('requeriments.edit', $requeriment));
    }

    /**
     * @test
     */
    public function it_deletes_the_requeriment()
    {
        $requeriment = Requeriment::factory()->create();

        $response = $this->delete(route('requeriments.destroy', $requeriment));

        $response->assertRedirect(route('requeriments.index'));

        $this->assertModelMissing($requeriment);
    }
}
