<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->sentence,
            'approved' => false
        ];
    }

    public function approved()
    {
        return $this->state(function (array $attributes) {
            return [
                'approved' => true
            ];
        });
    }

    public function disapproved()
    {
        return $this->state(function (array $attributes) {
            return [
                'approved' => false
            ];
        });
    }
}
