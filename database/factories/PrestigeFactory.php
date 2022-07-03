<?php

namespace Database\Factories;

use App\Models\Prestige;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestigeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prestige::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reputacion_institucional' => $this->faker->randomNumber(2),
            'practicas_profesionales' => $this->faker->randomNumber(2),
            'imagen_egresado' => $this->faker->randomNumber(2),
            'asociaciones_externas' => $this->faker->randomNumber(2),
            'bolsa_empleo' => $this->faker->randomNumber(2),
            'academic_program_id' => \App\Models\AcademicProgram::factory(),
        ];
    }
}
