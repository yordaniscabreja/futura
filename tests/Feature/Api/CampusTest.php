<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Campus;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampusTest extends TestCase
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
    public function it_gets_campuses_list()
    {
        $campuses = Campus::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.campuses.index'));

        $response->assertOk()->assertSee($campuses[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_campus()
    {
        $data = Campus::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.campuses.store'), $data);

        $this->assertDatabaseHas('campuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_campus()
    {
        $campus = Campus::factory()->create();

        $university = University::factory()->create();

        $data = [
            'conectividad' => $this->faker->randomNumber(2),
            'salones' => $this->faker->randomNumber(2),
            'laboratorios' => $this->faker->randomNumber(2),
            'cafeterias_restaurantes' => $this->faker->randomNumber(2),
            'espacios_comunes' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->putJson(
            route('api.campuses.update', $campus),
            $data
        );

        $data['id'] = $campus->id;

        $this->assertDatabaseHas('campuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_campus()
    {
        $campus = Campus::factory()->create();

        $response = $this->deleteJson(route('api.campuses.destroy', $campus));

        $this->assertModelMissing($campus);

        $response->assertNoContent();
    }
}
