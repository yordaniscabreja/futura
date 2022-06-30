<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryDepartmentsTest extends TestCase
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
    public function it_gets_country_departments()
    {
        $country = Country::factory()->create();
        $departments = Department::factory()
            ->count(2)
            ->create([
                'country_id' => $country->id,
            ]);

        $response = $this->getJson(
            route('api.countries.departments.index', $country)
        );

        $response->assertOk()->assertSee($departments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_country_departments()
    {
        $country = Country::factory()->create();
        $data = Department::factory()
            ->make([
                'country_id' => $country->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.countries.departments.store', $country),
            $data
        );

        $this->assertDatabaseHas('departments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $department = Department::latest('id')->first();

        $this->assertEquals($country->id, $department->country_id);
    }
}
