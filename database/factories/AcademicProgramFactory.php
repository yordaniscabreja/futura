<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AcademicProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AcademicProgram::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text,
            'snies_code' => $this->faker->text(255),
            'acreditado' => $this->faker->boolean,
            'credits' => $this->faker->randomNumber(0),
            'numero_duracion' => $this->faker->randomNumber(0),
            'periodo_duracion' => $this->faker->text(255),
            'jornada' => $this->faker->text(255),
            'precio' => $this->faker->text(255),
            'university_id' => \App\Models\University::factory(),
            'basic_core_id' => \App\Models\BasicCore::factory(),
            'academic_level_id' => \App\Models\AcademicLevel::factory(),
            'modality_id' => \App\Models\Modality::factory(),
            'education_level_id' => \App\Models\EducationLevel::factory(),
        ];
    }
}
