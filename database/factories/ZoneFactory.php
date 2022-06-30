<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'facilidad_transporte' => $this->faker->randomNumber(2),
            'seguridad_zona' => $this->faker->randomNumber(2),
            'opciones_parqueo' => $this->faker->randomNumber(2),
            'opciones_vivir' => $this->faker->randomNumber(2),
            'opciones_comer' => $this->faker->randomNumber(2),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
