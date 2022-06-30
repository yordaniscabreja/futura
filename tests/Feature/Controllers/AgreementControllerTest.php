<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Agreement;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgreementControllerTest extends TestCase
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
    public function it_displays_index_view_with_agreements()
    {
        $agreements = Agreement::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('agreements.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.agreements.index')
            ->assertViewHas('agreements');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_agreement()
    {
        $response = $this->get(route('agreements.create'));

        $response->assertOk()->assertViewIs('app.agreements.create');
    }

    /**
     * @test
     */
    public function it_stores_the_agreement()
    {
        $data = Agreement::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('agreements.store'), $data);

        $this->assertDatabaseHas('agreements', $data);

        $agreement = Agreement::latest('id')->first();

        $response->assertRedirect(route('agreements.edit', $agreement));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_agreement()
    {
        $agreement = Agreement::factory()->create();

        $response = $this->get(route('agreements.show', $agreement));

        $response
            ->assertOk()
            ->assertViewIs('app.agreements.show')
            ->assertViewHas('agreement');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_agreement()
    {
        $agreement = Agreement::factory()->create();

        $response = $this->get(route('agreements.edit', $agreement));

        $response
            ->assertOk()
            ->assertViewIs('app.agreements.edit')
            ->assertViewHas('agreement');
    }

    /**
     * @test
     */
    public function it_updates_the_agreement()
    {
        $agreement = Agreement::factory()->create();

        $university = University::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'duracion' => $this->faker->randomNumber(0),
            'representante' => $this->faker->text(255),
            'tasa_interes' => $this->faker->randomNumber(0),
            'tasa_descuento' => $this->faker->randomNumber(0),
            'university_id' => $university->id,
        ];

        $response = $this->put(route('agreements.update', $agreement), $data);

        $data['id'] = $agreement->id;

        $this->assertDatabaseHas('agreements', $data);

        $response->assertRedirect(route('agreements.edit', $agreement));
    }

    /**
     * @test
     */
    public function it_deletes_the_agreement()
    {
        $agreement = Agreement::factory()->create();

        $response = $this->delete(route('agreements.destroy', $agreement));

        $response->assertRedirect(route('agreements.index'));

        $this->assertModelMissing($agreement);
    }
}
