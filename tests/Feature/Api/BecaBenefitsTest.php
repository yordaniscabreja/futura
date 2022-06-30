<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Beca;
use App\Models\Benefit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BecaBenefitsTest extends TestCase
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
    public function it_gets_beca_benefits()
    {
        $beca = Beca::factory()->create();
        $benefits = Benefit::factory()
            ->count(2)
            ->create([
                'beca_id' => $beca->id,
            ]);

        $response = $this->getJson(route('api.becas.benefits.index', $beca));

        $response->assertOk()->assertSee($benefits[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_beca_benefits()
    {
        $beca = Beca::factory()->create();
        $data = Benefit::factory()
            ->make([
                'beca_id' => $beca->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.becas.benefits.store', $beca),
            $data
        );

        $this->assertDatabaseHas('benefits', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $benefit = Benefit::latest('id')->first();

        $this->assertEquals($beca->id, $benefit->beca_id);
    }
}
