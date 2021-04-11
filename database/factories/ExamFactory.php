<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'faculty_name' => 'MATF',
            'year' => 2020,
            'file' => 'jun2020.pdf',
            'title' => 'Prijemni ispit 2020'
        ];
    }
}
