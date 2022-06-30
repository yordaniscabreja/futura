<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bond;

use App\Models\Agreement;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BondTest extends TestCase
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
    public function it_gets_bonds_list()
    {
        $bonds = Bond::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bonds.index'));

        $response->assertOk()->assertSee($bonds[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_bond()
    {
        $data = Bond::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bonds.store'), $data);

        $this->assertDatabaseHas('bonds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bond()
    {
        $bond = Bond::factory()->create();

        $agreement = Agreement::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'agreement_id' => $agreement->id,
        ];

        $response = $this->putJson(route('api.bonds.update', $bond), $data);

        $data['id'] = $bond->id;

        $this->assertDatabaseHas('bonds', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bond()
    {
        $bond = Bond::factory()->create();

        $response = $this->deleteJson(route('api.bonds.destroy', $bond));

        $this->assertModelMissing($bond);

        $response->assertNoContent();
    }
}
