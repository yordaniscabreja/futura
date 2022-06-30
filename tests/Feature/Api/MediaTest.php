<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Media;

use App\Models\MediaType;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTest extends TestCase
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
    public function it_gets_all_media_list()
    {
        $allMedia = Media::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-media.index'));

        $response->assertOk()->assertSee($allMedia[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_media()
    {
        $data = Media::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-media.store'), $data);

        $this->assertDatabaseHas('media', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_media()
    {
        $media = Media::factory()->create();

        $mediaType = MediaType::factory()->create();
        $university = University::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'path' => $this->faker->text(255),
            'url' => $this->faker->url,
            'media_type_id' => $mediaType->id,
            'university_id' => $university->id,
        ];

        $response = $this->putJson(
            route('api.all-media.update', $media),
            $data
        );

        $data['id'] = $media->id;

        $this->assertDatabaseHas('media', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_media()
    {
        $media = Media::factory()->create();

        $response = $this->deleteJson(route('api.all-media.destroy', $media));

        $this->assertModelMissing($media);

        $response->assertNoContent();
    }
}
