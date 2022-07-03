<?php

namespace Database\Factories;

use App\Models\Campus;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'conectividad' => $this->faker->randomNumber(2),
            'salones' => $this->faker->randomNumber(2),
            'laboratorios' => $this->faker->randomNumber(2),
            'cafeterias_restaurantes' => $this->faker->randomNumber(2),
            'espacios_comunes' => $this->faker->randomNumber(2),
            'academic_program_id' => \App\Models\AcademicProgram::factory(),
        ];
    }
}
