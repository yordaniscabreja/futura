<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Media;
use App\Models\MediaType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTypeAllMediaTest extends TestCase
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
    public function it_gets_media_type_all_media()
    {
        $mediaType = MediaType::factory()->create();
        $allMedia = Media::factory()
            ->count(2)
            ->create([
                'media_type_id' => $mediaType->id,
            ]);

        $response = $this->getJson(
            route('api.media-types.all-media.index', $mediaType)
        );

        $response->assertOk()->assertSee($allMedia[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_media_type_all_media()
    {
        $mediaType = MediaType::factory()->create();
        $data = Media::factory()
            ->make([
                'media_type_id' => $mediaType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.media-types.all-media.store', $mediaType),
            $data
        );

        $this->assertDatabaseHas('media', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $media = Media::latest('id')->first();

        $this->assertEquals($mediaType->id, $media->media_type_id);
    }
}
