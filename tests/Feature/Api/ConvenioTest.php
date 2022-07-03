<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Convenio;

use App\Models\University;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConvenioTest extends TestCase
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
    public function it_gets_convenios_list()
    {
        $convenios = Convenio::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.convenios.index'));

        $response->assertOk()->assertSee($convenios[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_convenio()
    {
        $data = Convenio::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.convenios.store'), $data);

        $this->assertDatabaseHas('convenios', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.convenios.update', $convenio),
            $data
        );

        $data['id'] = $convenio->id;

        $this->assertDatabaseHas('convenios', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_convenio()
    {
        $convenio = Convenio::factory()->create();

        $response = $this->deleteJson(
            route('api.convenios.destroy', $convenio)
        );

        $this->assertModelMissing($convenio);

        $response->assertNoContent();
    }
}
