<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Beca;
use App\Models\Requeriment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BecaRequerimentsTest extends TestCase
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
    public function it_gets_beca_requeriments()
    {
        $beca = Beca::factory()->create();
        $requeriments = Requeriment::factory()
            ->count(2)
            ->create([
                'beca_id' => $beca->id,
            ]);

        $response = $this->getJson(
            route('api.becas.requeriments.index', $beca)
        );

        $response->assertOk()->assertSee($requeriments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_beca_requeriments()
    {
        $beca = Beca::factory()->create();
        $data = Requeriment::factory()
            ->make([
                'beca_id' => $beca->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.becas.requeriments.store', $beca),
            $data
        );

        $this->assertDatabaseHas('requeriments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $requeriment = Requeriment::latest('id')->first();

        $this->assertEquals($beca->id, $requeriment->beca_id);
    }
}
