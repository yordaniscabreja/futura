<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MediaType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_media_types()
    {
        $mediaTypes = MediaType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('media-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.media_types.index')
            ->assertViewHas('mediaTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_media_type()
    {
        $response = $this->get(route('media-types.create'));

        $response->assertOk()->assertViewIs('app.media_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_media_type()
    {
        $data = MediaType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('media-types.store'), $data);

        $this->assertDatabaseHas('media_types', $data);

        $mediaType = MediaType::latest('id')->first();

        $response->assertRedirect(route('media-types.edit', $mediaType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_media_type()
    {
        $mediaType = MediaType::factory()->create();

        $response = $this->get(route('media-types.show', $mediaType));

        $response
            ->assertOk()
            ->assertViewIs('app.media_types.show')
            ->assertViewHas('mediaType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_media_type()
    {
        $mediaType = MediaType::factory()->create();

        $response = $this->get(route('media-types.edit', $mediaType));

        $response
            ->assertOk()
            ->assertViewIs('app.media_types.edit')
            ->assertViewHas('mediaType');
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

        $response = $this->put(route('media-types.update', $mediaType), $data);

        $data['id'] = $mediaType->id;

        $this->assertDatabaseHas('media_types', $data);

        $response->assertRedirect(route('media-types.edit', $mediaType));
    }

    /**
     * @test
     */
    public function it_deletes_the_media_type()
    {
        $mediaType = MediaType::factory()->create();

        $response = $this->delete(route('media-types.destroy', $mediaType));

        $response->assertRedirect(route('media-types.index'));

        $this->assertModelMissing($mediaType);
    }
}
