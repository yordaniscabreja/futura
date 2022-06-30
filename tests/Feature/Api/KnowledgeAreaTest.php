<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\KnowledgeArea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeAreaTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_knowledge_areas_list()
    {
        $knowledgeAreas = KnowledgeArea::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.knowledge-areas.index'));

        $response->assertOk()->assertSee($knowledgeAreas[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_area()
    {
        $data = KnowledgeArea::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.knowledge-areas.store'), $data);

        $this->assertDatabaseHas('knowledge_areas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.knowledge-areas.update', $knowledgeArea),
            $data
        );

        $data['id'] = $knowledgeArea->id;

        $this->assertDatabaseHas('knowledge_areas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_knowledge_area()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();

        $response = $this->deleteJson(
            route('api.knowledge-areas.destroy', $knowledgeArea)
        );

        $this->assertModelMissing($knowledgeArea);

        $response->assertNoContent();
    }
}
