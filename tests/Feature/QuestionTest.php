<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Question;
use App\Models\Answer;

class QuestionTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     **/
    public function question_can_be_given_an_answer()
    {

        $question = Question::factory()->create();

        $answer = Answer::factory()->raw();


        $question->giveAnswer($answer);

        $this->assertCount(1, $question->answers);
    }

    /**
     *@test
     **/
    public function answer_cannot_be_created_for_disaproved_question()
    {

        $question = Question::factory()->state('disapproved')->create();

        $answer = Answer::factory()->raw();

        $question->giveAnswer($answer);

        $this->assertCount(0, $question->answers);
    }
}
