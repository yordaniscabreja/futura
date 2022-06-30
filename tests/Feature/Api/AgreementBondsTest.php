<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bond;
use App\Models\Agreement;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgreementBondsTest extends TestCase
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
    public function it_gets_agreement_bonds()
    {
        $agreement = Agreement::factory()->create();
        $bonds = Bond::factory()
            ->count(2)
            ->create([
                'agreement_id' => $agreement->id,
            ]);

        $response = $this->getJson(
            route('api.agreements.bonds.index', $agreement)
        );

        $response->assertOk()->assertSee($bonds[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_agreement_bonds()
    {
        $agreement = Agreement::factory()->create();
        $data = Bond::factory()
            ->make([
                'agreement_id' => $agreement->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.agreements.bonds.store', $agreement),
            $data
        );

        $this->assertDatabaseHas('bonds', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bond = Bond::latest('id')->first();

        $this->assertEquals($agreement->id, $bond->agreement_id);
    }
}
