<?php

namespace Database\Factories;

use App\Models\Rectoria;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RectoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rectoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'position' => $this->faker->text(255),
            'image' => $this->faker->text(255),
            'last_name' => $this->faker->lastName,
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
