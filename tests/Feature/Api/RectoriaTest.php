<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Rectoria;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RectoriaTest extends TestCase
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
    public function it_gets_rectorias_list()
    {
        $rectorias = Rectoria::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.rectorias.index'));

        $response->assertOk()->assertSee($rectorias[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_rectoria()
    {
        $data = Rectoria::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.rectorias.store'), $data);

        $this->assertDatabaseHas('rectorias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.rectorias.update', $rectoria),
            $data
        );

        $data['id'] = $rectoria->id;

        $this->assertDatabaseHas('rectorias', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_rectoria()
    {
        $rectoria = Rectoria::factory()->create();

        $response = $this->deleteJson(
            route('api.rectorias.destroy', $rectoria)
        );

        $this->assertModelMissing($rectoria);

        $response->assertNoContent();
    }
}
