<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Modality;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModalityTest extends TestCase
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
    public function it_gets_modalities_list()
    {
        $modalities = Modality::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.modalities.index'));

        $response->assertOk()->assertSee($modalities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_modality()
    {
        $data = Modality::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.modalities.store'), $data);

        $this->assertDatabaseHas('modalities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.modalities.update', $modality),
            $data
        );

        $data['id'] = $modality->id;

        $this->assertDatabaseHas('modalities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_modality()
    {
        $modality = Modality::factory()->create();

        $response = $this->deleteJson(
            route('api.modalities.destroy', $modality)
        );

        $this->assertModelMissing($modality);

        $response->assertNoContent();
    }
}
