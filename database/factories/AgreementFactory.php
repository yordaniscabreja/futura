<?php

namespace Database\Factories;

use App\Models\Agreement;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agreement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'duracion' => $this->faker->randomNumber(0),
            'representante' => $this->faker->text(255),
            'tasa_interes' => $this->faker->randomNumber(0),
            'tasa_descuento' => $this->faker->randomNumber(0),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
