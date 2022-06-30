<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Modality;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModalityControllerTest extends TestCase
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
    public function it_displays_index_view_with_modalities()
    {
        $modalities = Modality::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('modalities.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.modalities.index')
            ->assertViewHas('modalities');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_modality()
    {
        $response = $this->get(route('modalities.create'));

        $response->assertOk()->assertViewIs('app.modalities.create');
    }

    /**
     * @test
     */
    public function it_stores_the_modality()
    {
        $data = Modality::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('modalities.store'), $data);

        $this->assertDatabaseHas('modalities', $data);

        $modality = Modality::latest('id')->first();

        $response->assertRedirect(route('modalities.edit', $modality));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_modality()
    {
        $modality = Modality::factory()->create();

        $response = $this->get(route('modalities.show', $modality));

        $response
            ->assertOk()
            ->assertViewIs('app.modalities.show')
            ->assertViewHas('modality');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_modality()
    {
        $modality = Modality::factory()->create();

        $response = $this->get(route('modalities.edit', $modality));

        $response
            ->assertOk()
            ->assertViewIs('app.modalities.edit')
            ->assertViewHas('modality');
    }

    /**
     * @test
     */
    public function it_updates_the_modality()
    {
        $modality = Modality::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->put(route('modalities.update', $modality), $data);

        $data['id'] = $modality->id;

        $this->assertDatabaseHas('modalities', $data);

        $response->assertRedirect(route('modalities.edit', $modality));
    }

    /**
     * @test
     */
    public function it_deletes_the_modality()
    {
        $modality = Modality::factory()->create();

        $response = $this->delete(route('modalities.destroy', $modality));

        $response->assertRedirect(route('modalities.index'));

        $this->assertModelMissing($modality);
    }
}
