<?php

namespace Database\Factories;

use App\Models\Economy;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EconomyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Economy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'financiacion' => $this->faker->randomNumber(2),
            'becas_auxilio' => $this->faker->randomNumber(2),
            'costos_calidad' => $this->faker->randomNumber(2),
            'costos_manutencion' => $this->faker->randomNumber(2),
            'costos_parqueadero' => $this->faker->randomNumber(2),
            'academic_program_id' => \App\Models\AcademicProgram::factory(),
        ];
    }
}
