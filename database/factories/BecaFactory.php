<?php

namespace Database\Factories;

use App\Models\Beca;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BecaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Beca::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'academic_program_id' => \App\Models\AcademicProgram::factory(),
        ];
    }
}
