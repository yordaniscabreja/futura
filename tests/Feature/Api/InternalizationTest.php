<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Internalization;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InternalizationTest extends TestCase
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
    public function it_gets_internalizations_list()
    {
        $internalizations = Internalization::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.internalizations.index'));

        $response->assertOk()->assertSee($internalizations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_internalization()
    {
        $data = Internalization::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.internalizations.store'), $data);

        $this->assertDatabaseHas('internalizations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_internalization()
    {
        $internalization = Internalization::factory()->create();

        $university = University::factory()->create();

        $data = [
            'intercambios_movilidad' => $this->faker->randomNumber(2),
            'facilidad_acceso' => $this->faker->randomNumber(2),
            'relevancia_internacional' => $this->faker->randomNumber(2),
            'convenios_internacionales' => $this->faker->randomNumber(2),
            'segundo_idioma' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->putJson(
            route('api.internalizations.update', $internalization),
            $data
        );

        $data['id'] = $internalization->id;

        $this->assertDatabaseHas('internalizations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_internalization()
    {
        $internalization = Internalization::factory()->create();

        $response = $this->deleteJson(
            route('api.internalizations.destroy', $internalization)
        );

        $this->assertModelMissing($internalization);

        $response->assertNoContent();
    }
}
