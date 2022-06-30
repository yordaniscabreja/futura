<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Internalization;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternalizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Internalization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'intercambios_movilidad' => $this->faker->randomNumber(2),
            'facilidad_acceso' => $this->faker->randomNumber(2),
            'relevancia_internacional' => $this->faker->randomNumber(2),
            'convenios_internacionales' => $this->faker->randomNumber(2),
            'segundo_idioma' => $this->faker->randomNumber(2),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
