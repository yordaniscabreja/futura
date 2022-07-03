<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'semestre' => $this->faker->randomNumber(0),
            'user_id' => \App\Models\User::factory(),
            'academic_program_id' => \App\Models\AcademicProgram::factory(),
        ];
    }
}
