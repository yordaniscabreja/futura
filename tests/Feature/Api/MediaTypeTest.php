<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MediaType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTypeTest extends TestCase
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
    public function it_gets_media_types_list()
    {
        $mediaTypes = MediaType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.media-types.index'));

        $response->assertOk()->assertSee($mediaTypes[0]->type);
    }

    /**
     * @test
     */
    public function it_stores_the_media_type()
    {
        $data = MediaType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.media-types.store'), $data);

        $this->assertDatabaseHas('media_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_media_type()
    {
        $mediaType = MediaType::factory()->create();

        $data = [
            'type' => $this->faker->word,
        ];

        $response = $this->putJson(
            route('api.media-types.update', $mediaType),
            $data
        );

        $data['id'] = $mediaType->id;

        $this->assertDatabaseHas('media_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_media_type()
    {
        $mediaType = MediaType::factory()->create();

        $response = $this->deleteJson(
            route('api.media-types.destroy', $mediaType)
        );

        $this->assertModelMissing($mediaType);

        $response->assertNoContent();
    }
}
