<?php

namespace Database\Factories;

use App\Models\Wellness;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WellnessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wellness::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'orientacion_psicologia' => $this->faker->randomNumber(2),
            'actividades_deportivas' => $this->faker->randomNumber(2),
            'actividades_culturales' => $this->faker->randomNumber(2),
            'plan_covid19' => $this->faker->randomNumber(2),
            'felicidad_entorno' => $this->faker->randomNumber(2),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
