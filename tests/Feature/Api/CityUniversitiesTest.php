<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityUniversitiesTest extends TestCase
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
    public function it_gets_city_universities()
    {
        $city = City::factory()->create();
        $universities = University::factory()
            ->count(2)
            ->create([
                'city_id' => $city->id,
            ]);

        $response = $this->getJson(
            route('api.cities.universities.index', $city)
        );

        $response->assertOk()->assertSee($universities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_city_universities()
    {
        $city = City::factory()->create();
        $data = University::factory()
            ->make([
                'city_id' => $city->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.cities.universities.store', $city),
            $data
        );

        $this->assertDatabaseHas('universities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $university = University::latest('id')->first();

        $this->assertEquals($city->id, $university->city_id);
    }
}
