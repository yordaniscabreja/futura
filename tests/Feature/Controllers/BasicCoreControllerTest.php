<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BasicCore;

use App\Models\KnowledgeArea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicCoreControllerTest extends TestCase
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
    public function it_displays_index_view_with_basic_cores()
    {
        $basicCores = BasicCore::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('basic-cores.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.basic_cores.index')
            ->assertViewHas('basicCores');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_basic_core()
    {
        $response = $this->get(route('basic-cores.create'));

        $response->assertOk()->assertViewIs('app.basic_cores.create');
    }

    /**
     * @test
     */
    public function it_stores_the_basic_core()
    {
        $data = BasicCore::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('basic-cores.store'), $data);

        $this->assertDatabaseHas('basic_cores', $data);

        $basicCore = BasicCore::latest('id')->first();

        $response->assertRedirect(route('basic-cores.edit', $basicCore));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_basic_core()
    {
        $basicCore = BasicCore::factory()->create();

        $response = $this->get(route('basic-cores.show', $basicCore));

        $response
            ->assertOk()
            ->assertViewIs('app.basic_cores.show')
            ->assertViewHas('basicCore');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_basic_core()
    {
        $basicCore = BasicCore::factory()->create();

        $response = $this->get(route('basic-cores.edit', $basicCore));

        $response
            ->assertOk()
            ->assertViewIs('app.basic_cores.edit')
            ->assertViewHas('basicCore');
    }

    /**
     * @test
     */
    public function it_updates_the_basic_core()
    {
        $basicCore = BasicCore::factory()->create();

        $knowledgeArea = KnowledgeArea::factory()->create();

        $data = [
            'name' => $this->faker->text,
            'knowledge_area_id' => $knowledgeArea->id,
        ];

        $response = $this->put(route('basic-cores.update', $basicCore), $data);

        $data['id'] = $basicCore->id;

        $this->assertDatabaseHas('basic_cores', $data);

        $response->assertRedirect(route('basic-cores.edit', $basicCore));
    }

    /**
     * @test
     */
    public function it_deletes_the_basic_core()
    {
        $basicCore = BasicCore::factory()->create();

        $response = $this->delete(route('basic-cores.destroy', $basicCore));

        $response->assertRedirect(route('basic-cores.index'));

        $this->assertModelMissing($basicCore);
    }
}
