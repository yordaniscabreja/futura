<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\University;

use App\Models\City;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityTest extends TestCase
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
    public function it_gets_universities_list()
    {
        $universities = University::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.universities.index'));

        $response->assertOk()->assertSee($universities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_university()
    {
        $data = University::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.universities.store'), $data);

        $this->assertDatabaseHas('universities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_university()
    {
        $university = University::factory()->create();

        $city = City::factory()->create();

        $data = [
            'name' => $this->faker->text,
            'oficial' => $this->faker->boolean,
            'acreditada' => $this->faker->boolean,
            'principal' => $this->faker->boolean,
            'url' => $this->faker->url,
            'direccion' => $this->faker->text,
            'fundada_at' => $this->faker->dateTime,
            'egresados' => $this->faker->randomNumber(2),
            'general_description' => $this->faker->sentence(15),
            'background_image' => $this->faker->text(255),
            'about_video_url' => $this->faker->text(255),
            'city_id' => $city->id,
        ];

        $response = $this->putJson(
            route('api.universities.update', $university),
            $data
        );

        $data['id'] = $university->id;

        $this->assertDatabaseHas('universities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_university()
    {
        $university = University::factory()->create();

        $response = $this->deleteJson(
            route('api.universities.destroy', $university)
        );

        $this->assertModelMissing($university);

        $response->assertNoContent();
    }
}
