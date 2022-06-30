<?php

namespace Database\Factories;

use App\Models\BasicCore;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasicCoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BasicCore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
            'knowledge_area_id' => \App\Models\KnowledgeArea::factory(),
        ];
    }
}
