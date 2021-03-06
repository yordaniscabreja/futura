<?php

namespace Database\Factories;

use App\Models\MediaType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MediaType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
        ];
    }
}
