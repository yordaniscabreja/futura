<?php

namespace Database\Factories;

use App\Models\Academy;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Academy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plan_estudio' => $this->faker->randomNumber(2),
            'recursos_academicos' => $this->faker->randomNumber(2),
            'tecnologia' => $this->faker->randomNumber(2),
            'tamano_grupos' => $this->faker->randomNumber(2),
            'excelencia_profesores' => $this->faker->randomNumber(2),
            'academic_program_id' => \App\Models\AcademicProgram::factory(),
        ];
    }
}
