<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Zone;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZoneTest extends TestCase
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
    public function it_gets_zones_list()
    {
        $zones = Zone::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.zones.index'));

        $response->assertOk()->assertSee($zones[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_zone()
    {
        $data = Zone::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.zones.store'), $data);

        $this->assertDatabaseHas('zones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_zone()
    {
        $zone = Zone::factory()->create();

        $university = University::factory()->create();

        $data = [
            'facilidad_transporte' => $this->faker->randomNumber(2),
            'seguridad_zona' => $this->faker->randomNumber(2),
            'opciones_parqueo' => $this->faker->randomNumber(2),
            'opciones_vivir' => $this->faker->randomNumber(2),
            'opciones_comer' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->putJson(route('api.zones.update', $zone), $data);

        $data['id'] = $zone->id;

        $this->assertDatabaseHas('zones', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_zone()
    {
        $zone = Zone::factory()->create();

        $response = $this->deleteJson(route('api.zones.destroy', $zone));

        $this->assertModelMissing($zone);

        $response->assertNoContent();
    }
}
