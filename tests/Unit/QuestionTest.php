<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Question;
use App\Models\Answer;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     **/
    public function new_question_can_be_created()
    {

        $question = Question::create([
            'text' => '2+2=',
            'approved' => true,

        ]);


        $this->assertDatabaseHas('questions', ['text' => '2+2=', 'approved' => true]);
    }


    /**
     *@test
     **/
    public function question_can_have_many_awswers()
    {
        $question = Question::factory()->create();

        $answer = Answer::factory()->count(2)->create(['question_id' => $question->id]);


        $this->assertCount(2, $question->answers);
    }
}
