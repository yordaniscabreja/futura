<?php

namespace Database\Factories;

use App\Models\Modality;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(255),
        ];
    }
}
