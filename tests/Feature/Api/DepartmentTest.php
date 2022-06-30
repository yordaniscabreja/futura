<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Department;

use App\Models\Country;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
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
    public function it_gets_departments_list()
    {
        $departments = Department::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.departments.index'));

        $response->assertOk()->assertSee($departments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_department()
    {
        $data = Department::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.departments.store'), $data);

        $this->assertDatabaseHas('departments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_department()
    {
        $department = Department::factory()->create();

        $country = Country::factory()->create();

        $data = [
            'name' => $this->faker->text,
            'country_id' => $country->id,
        ];

        $response = $this->putJson(
            route('api.departments.update', $department),
            $data
        );

        $data['id'] = $department->id;

        $this->assertDatabaseHas('departments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_department()
    {
        $department = Department::factory()->create();

        $response = $this->deleteJson(
            route('api.departments.destroy', $department)
        );

        $this->assertModelMissing($department);

        $response->assertNoContent();
    }
}
