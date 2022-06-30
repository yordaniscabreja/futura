<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Media;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UniversityAllMediaTest extends TestCase
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
    public function it_gets_university_all_media()
    {
        $university = University::factory()->create();
        $allMedia = Media::factory()
            ->count(2)
            ->create([
                'university_id' => $university->id,
            ]);

        $response = $this->getJson(
            route('api.universities.all-media.index', $university)
        );

        $response->assertOk()->assertSee($allMedia[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_university_all_media()
    {
        $university = University::factory()->create();
        $data = Media::factory()
            ->make([
                'university_id' => $university->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.universities.all-media.store', $university),
            $data
        );

        $this->assertDatabaseHas('media', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $media = Media::latest('id')->first();

        $this->assertEquals($university->id, $media->university_id);
    }
}
