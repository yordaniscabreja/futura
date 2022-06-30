<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Benefit;

use App\Models\Beca;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BenefitTest extends TestCase
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
    public function it_gets_benefits_list()
    {
        $benefits = Benefit::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.benefits.index'));

        $response->assertOk()->assertSee($benefits[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_benefit()
    {
        $data = Benefit::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.benefits.store'), $data);

        $this->assertDatabaseHas('benefits', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.benefits.update', $benefit),
            $data
        );

        $data['id'] = $benefit->id;

        $this->assertDatabaseHas('benefits', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_benefit()
    {
        $benefit = Benefit::factory()->create();

        $response = $this->deleteJson(route('api.benefits.destroy', $benefit));

        $this->assertModelMissing($benefit);

        $response->assertNoContent();
    }
}
