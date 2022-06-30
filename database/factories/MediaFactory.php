<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'path' => $this->faker->text(255),
            'url' => $this->faker->url,
            'media_type_id' => \App\Models\MediaType::factory(),
            'university_id' => \App\Models\University::factory(),
        ];
    }
}
