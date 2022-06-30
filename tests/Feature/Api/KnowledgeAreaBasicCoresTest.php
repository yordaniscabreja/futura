<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BasicCore;
use App\Models\KnowledgeArea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeAreaBasicCoresTest extends TestCase
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
    public function it_gets_knowledge_area_basic_cores()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();
        $basicCores = BasicCore::factory()
            ->count(2)
            ->create([
                'knowledge_area_id' => $knowledgeArea->id,
            ]);

        $response = $this->getJson(
            route('api.knowledge-areas.basic-cores.index', $knowledgeArea)
        );

        $response->assertOk()->assertSee($basicCores[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_knowledge_area_basic_cores()
    {
        $knowledgeArea = KnowledgeArea::factory()->create();
        $data = BasicCore::factory()
            ->make([
                'knowledge_area_id' => $knowledgeArea->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.knowledge-areas.basic-cores.store', $knowledgeArea),
            $data
        );

        $this->assertDatabaseHas('basic_cores', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $basicCore = BasicCore::latest('id')->first();

        $this->assertEquals($knowledgeArea->id, $basicCore->knowledge_area_id);
    }
}
