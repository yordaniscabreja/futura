<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = University::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
            'oficial' => $this->faker->boolean,
            'acreditada' => $this->faker->boolean,
            'principal' => $this->faker->boolean,
            'url' => $this->faker->url,
            'direccion' => $this->faker->text,
            'fundada_at' => $this->faker->dateTime,
            'egresados' => $this->faker->randomNumber(2),
            'general_description' => $this->faker->sentence(15),
            'background_image' => $this->faker->text(255),
            'about_video_url' => $this->faker->text(255),
            'city_id' => \App\Models\City::factory(),
        ];
    }
}
