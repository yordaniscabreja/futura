<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agreement;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgreementTest extends TestCase
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
    public function it_gets_agreements_list()
    {
        $agreements = Agreement::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.agreements.index'));

        $response->assertOk()->assertSee($agreements[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_agreement()
    {
        $data = Agreement::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.agreements.store'), $data);

        $this->assertDatabaseHas('agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.agreements.update', $agreement),
            $data
        );

        $data['id'] = $agreement->id;

        $this->assertDatabaseHas('agreements', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_agreement()
    {
        $agreement = Agreement::factory()->create();

        $response = $this->deleteJson(
            route('api.agreements.destroy', $agreement)
        );

        $this->assertModelMissing($agreement);

        $response->assertNoContent();
    }
}
