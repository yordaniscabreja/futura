<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BasicCore;

use App\Models\KnowledgeArea;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicCoreTest extends TestCase
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
    public function it_gets_basic_cores_list()
    {
        $basicCores = BasicCore::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.basic-cores.index'));

        $response->assertOk()->assertSee($basicCores[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_basic_core()
    {
        $data = BasicCore::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.basic-cores.store'), $data);

        $this->assertDatabaseHas('basic_cores', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.basic-cores.update', $basicCore),
            $data
        );

        $data['id'] = $basicCore->id;

        $this->assertDatabaseHas('basic_cores', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_basic_core()
    {
        $basicCore = BasicCore::factory()->create();

        $response = $this->deleteJson(
            route('api.basic-cores.destroy', $basicCore)
        );

        $this->assertModelMissing($basicCore);

        $response->assertNoContent();
    }
}
