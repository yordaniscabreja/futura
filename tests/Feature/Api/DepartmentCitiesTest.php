<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\City;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentCitiesTest extends TestCase
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
    public function it_gets_department_cities()
    {
        $department = Department::factory()->create();
        $cities = City::factory()
            ->count(2)
            ->create([
                'department_id' => $department->id,
            ]);

        $response = $this->getJson(
            route('api.departments.cities.index', $department)
        );

        $response->assertOk()->assertSee($cities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_department_cities()
    {
        $department = Department::factory()->create();
        $data = City::factory()
            ->make([
                'department_id' => $department->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.departments.cities.store', $department),
            $data
        );

        $this->assertDatabaseHas('cities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $city = City::latest('id')->first();

        $this->assertEquals($department->id, $city->department_id);
    }
}
