<?php

namespace Database\Factories;

use App\Models\LifeStyle;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LifeStyleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LifeStyle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ambiente' => $this->faker->randomNumber(2),
            'diversion_ocio' => $this->faker->randomNumber(2),
            'descanso_relax' => $this->faker->randomNumber(2),
            'cultura_ecologica' => $this->faker->randomNumber(2),
            'servicio_estudiante' => $this->faker->randomNumber(2),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
