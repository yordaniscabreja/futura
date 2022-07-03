<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Convenio;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConvenioControllerTest extends TestCase
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
    public function it_displays_index_view_with_convenios()
    {
        $convenios = Convenio::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('convenios.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.convenios.index')
            ->assertViewHas('convenios');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_convenio()
    {
        $response = $this->get(route('convenios.create'));

        $response->assertOk()->assertViewIs('app.convenios.create');
    }

    /**
     * @test
     */
    public function it_stores_the_convenio()
    {
        $data = Convenio::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('convenios.store'), $data);

        $this->assertDatabaseHas('convenios', $data);

        $convenio = Convenio::latest('id')->first();

        $response->assertRedirect(route('convenios.edit', $convenio));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_convenio()
    {
        $convenio = Convenio::factory()->create();

        $response = $this->get(route('convenios.show', $convenio));

        $response
            ->assertOk()
            ->assertViewIs('app.convenios.show')
            ->assertViewHas('convenio');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_convenio()
    {
        $convenio = Convenio::factory()->create();

        $response = $this->get(route('convenios.edit', $convenio));

        $response
            ->assertOk()
            ->assertViewIs('app.convenios.edit')
            ->assertViewHas('convenio');
    }

    /**
     * @test
     */
    public function it_updates_the_convenio()
    {
        $convenio = Convenio::factory()->create();

        $university = University::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'about' => $this->faker->text,
            'university_id' => $university->id,
        ];

        $response = $this->put(route('convenios.update', $convenio), $data);

        $data['id'] = $convenio->id;

        $this->assertDatabaseHas('convenios', $data);

        $response->assertRedirect(route('convenios.edit', $convenio));
    }

    /**
     * @test
     */
    public function it_deletes_the_convenio()
    {
        $convenio = Convenio::factory()->create();

        $response = $this->delete(route('convenios.destroy', $convenio));

        $response->assertRedirect(route('convenios.index'));

        $this->assertModelMissing($convenio);
    }
}
