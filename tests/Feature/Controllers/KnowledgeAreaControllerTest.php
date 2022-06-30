<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\KnowledgeArea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeAreaControllerTest extends TestCase
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
    public function it_displays_index_view_with_knowledge_areas()
    {
        $knowledgeAreas = KnowledgeArea::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('knowledge-areas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.knowledge_areas.index')
            ->assertViewHas('knowledgeAreas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_knowledge_area()
    {
        $response = $this->get(route('knowledge-areas.create'));

        $response->assertOk()->assertViewIs('app.knowledge_areas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_area()
    {
        $data = KnowledgeArea::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('knowledge-areas.store'), $data);

        $this->assertDatabaseHas('knowledge_areas', $data);

        $knowledgeArea = KnowledgeArea::latest('id')->first();

        $response->assertRedirect(
            route('knowledge-areas.edit', $knowledgeArea)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_knowledge_area()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();

        $response = $this->get(route('knowledge-areas.show', $knowledgeArea));

        $response
            ->assertOk()
            ->assertViewIs('app.knowledge_areas.show')
            ->assertViewHas('knowledgeArea');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_knowledge_area()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();

        $response = $this->get(route('knowledge-areas.edit', $knowledgeArea));

        $response
            ->assertOk()
            ->assertViewIs('app.knowledge_areas.edit')
            ->assertViewHas('knowledgeArea');
    }

    /**
     * @test
     */
    public function it_updates_the_knowledge_area()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();

        $data = [
            'name' => $this->faker->text,
        ];

        $response = $this->put(
            route('knowledge-areas.update', $knowledgeArea),
            $data
        );

        $data['id'] = $knowledgeArea->id;

        $this->assertDatabaseHas('knowledge_areas', $data);

        $response->assertRedirect(
            route('knowledge-areas.edit', $knowledgeArea)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_knowledge_area()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();

        $response = $this->delete(
            route('knowledge-areas.destroy', $knowledgeArea)
        );

        $response->assertRedirect(route('knowledge-areas.index'));

        $this->assertModelMissing($knowledgeArea);
    }
}
