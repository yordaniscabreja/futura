<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\LifeStyle;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityLifeStylesTest extends TestCase
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
    public function it_gets_university_life_styles()
    {
        $university = University::factory()->create();
        $lifeStyles = LifeStyle::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.life-styles.index', $university)
        );

        $response->assertOk()->assertSee($lifeStyles[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_university_life_styles()
    {
        $university = University::factory()->create();
        $data = LifeStyle::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.life-styles.store', $university),
            $data
        );

        $this->assertDatabaseHas('life_styles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $lifeStyle = LifeStyle::latest('id')->first();

        $this->assertEquals($university->id, $lifeStyle->university_id);
    }
}
