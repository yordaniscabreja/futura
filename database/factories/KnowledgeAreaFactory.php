<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\KnowledgeArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class KnowledgeAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = KnowledgeArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
        ];
    }
}
