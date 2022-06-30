<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Benefit;

use App\Models\Beca;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BenefitControllerTest extends TestCase
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
    public function it_displays_index_view_with_benefits()
    {
        $benefits = Benefit::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('benefits.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.benefits.index')
            ->assertViewHas('benefits');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_benefit()
    {
        $response = $this->get(route('benefits.create'));

        $response->assertOk()->assertViewIs('app.benefits.create');
    }

    /**
     * @test
     */
    public function it_stores_the_benefit()
    {
        $data = Benefit::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('benefits.store'), $data);

        $this->assertDatabaseHas('benefits', $data);

        $benefit = Benefit::latest('id')->first();

        $response->assertRedirect(route('benefits.edit', $benefit));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_benefit()
    {
        $benefit = Benefit::factory()->create();

        $response = $this->get(route('benefits.show', $benefit));

        $response
            ->assertOk()
            ->assertViewIs('app.benefits.show')
            ->assertViewHas('benefit');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_benefit()
    {
        $benefit = Benefit::factory()->create();

        $response = $this->get(route('benefits.edit', $benefit));

        $response
            ->assertOk()
            ->assertViewIs('app.benefits.edit')
            ->assertViewHas('benefit');
    }

    /**
     * @test
     */
    public function it_updates_the_benefit()
    {
        $benefit = Benefit::factory()->create();

        $beca = Beca::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'beca_id' => $beca->id,
        ];

        $response = $this->put(route('benefits.update', $benefit), $data);

        $data['id'] = $benefit->id;

        $this->assertDatabaseHas('benefits', $data);

        $response->assertRedirect(route('benefits.edit', $benefit));
    }

    /**
     * @test
     */
    public function it_deletes_the_benefit()
    {
        $benefit = Benefit::factory()->create();

        $response = $this->delete(route('benefits.destroy', $benefit));

        $response->assertRedirect(route('benefits.index'));

        $this->assertModelMissing($benefit);
    }
}
