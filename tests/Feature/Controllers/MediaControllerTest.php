<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Media;

use App\Models\MediaType;
use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_media()
    {
        $allMedia = Media::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-media.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_media.index')
            ->assertViewHas('allMedia');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_media()
    {
        $response = $this->get(route('all-media.create'));

        $response->assertOk()->assertViewIs('app.all_media.create');
    }

    /**
     * @test
     */
    public function it_stores_the_media()
    {
        $data = Media::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-media.store'), $data);

        $this->assertDatabaseHas('media', $data);

        $media = Media::latest('id')->first();

        $response->assertRedirect(route('all-media.edit', $media));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_media()
    {
        $media = Media::factory()->create();

        $response = $this->get(route('all-media.show', $media));

        $response
            ->assertOk()
            ->assertViewIs('app.all_media.show')
            ->assertViewHas('media');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_media()
    {
        $media = Media::factory()->create();

        $response = $this->get(route('all-media.edit', $media));

        $response
            ->assertOk()
            ->assertViewIs('app.all_media.edit')
            ->assertViewHas('media');
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

        $response = $this->put(route('all-media.update', $media), $data);

        $data['id'] = $media->id;

        $this->assertDatabaseHas('media', $data);

        $response->assertRedirect(route('all-media.edit', $media));
    }

    /**
     * @test
     */
    public function it_deletes_the_media()
    {
        $media = Media::factory()->create();

        $response = $this->delete(route('all-media.destroy', $media));

        $response->assertRedirect(route('all-media.index'));

        $this->assertModelMissing($media);
    }
}
