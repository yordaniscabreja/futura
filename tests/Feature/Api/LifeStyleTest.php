<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\LifeStyle;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LifeStyleTest extends TestCase
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
    public function it_gets_life_styles_list()
    {
        $lifeStyles = LifeStyle::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.life-styles.index'));

        $response->assertOk()->assertSee($lifeStyles[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_life_style()
    {
        $data = LifeStyle::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.life-styles.store'), $data);

        $this->assertDatabaseHas('life_styles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_life_style()
    {
        $lifeStyle = LifeStyle::factory()->create();

        $university = University::factory()->create();

        $data = [
            'ambiente' => $this->faker->randomNumber(2),
            'diversion_ocio' => $this->faker->randomNumber(2),
            'descanso_relax' => $this->faker->randomNumber(2),
            'cultura_ecologica' => $this->faker->randomNumber(2),
            'servicio_estudiante' => $this->faker->randomNumber(2),
            'university_id' => $university->id,
        ];

        $response = $this->putJson(
            route('api.life-styles.update', $lifeStyle),
            $data
        );

        $data['id'] = $lifeStyle->id;

        $this->assertDatabaseHas('life_styles', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_life_style()
    {
        $lifeStyle = LifeStyle::factory()->create();

        $response = $this->deleteJson(
            route('api.life-styles.destroy', $lifeStyle)
        );

        $this->assertModelMissing($lifeStyle);

        $response->assertNoContent();
    }
}
