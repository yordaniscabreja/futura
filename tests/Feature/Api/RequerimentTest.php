<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Requeriment;

use App\Models\Beca;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequerimentTest extends TestCase
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
    public function it_gets_requeriments_list()
    {
        $requeriments = Requeriment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.requeriments.index'));

        $response->assertOk()->assertSee($requeriments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_requeriment()
    {
        $data = Requeriment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.requeriments.store'), $data);

        $this->assertDatabaseHas('requeriments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.requeriments.update', $requeriment),
            $data
        );

        $data['id'] = $requeriment->id;

        $this->assertDatabaseHas('requeriments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_requeriment()
    {
        $requeriment = Requeriment::factory()->create();

        $response = $this->deleteJson(
            route('api.requeriments.destroy', $requeriment)
        );

        $this->assertModelMissing($requeriment);

        $response->assertNoContent();
    }
}
