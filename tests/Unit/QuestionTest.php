<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     **/
    protected $exam;

    protected function setUp(): void
    {
        parent::setUp();
        $this->exam = Exam::factory()->create();
    }
    public function new_question_can_be_created_for_exam()
    {


        $question = Question::factory()->exam()->create([
            'questionable_id' => $this->exam->id,
            'text' => '2+2=',
            'approved' => true,
        ]);


        $this->assertDatabaseHas('questionables', ['text' => '2+2=', 'approved' => true]);
    }


    /**
     *@test
     **/
    public function question_can_have_many_awswers()
    {

        $question = Question::factory()
            ->exam()
            ->create(['questionable_id' => $this->exam->id]);

        $answer = Answer::factory()->count(2)->create(['questionable_id' => $question->id]);


        $this->assertCount(2, $question->answers);
    }


    /**
     *@test
     **/
    public function question_can_be_attached_to_category()
    {

        $question = Question::factory()
            ->exam()
            ->create(['questionable_id' => $this->exam->id]);
        $category = Category::create([
            'title' => 'Sabiranje brojeva'
        ]);


        $category->addQuestion($question);

        $this->assertCount(1, $question->categories()->get());
    }


    /**
     *@test
     **/
    public function question_can_be_rated()
    {


        $question = Question::factory()
            ->exam()
            ->create(['questionable_id' => $this->exam->id]);

        $question->rate(4);

        $this->assertCount(1, $question->ratings()->get());
    }




    /**
     *@test
     **/
    public function answer_cannot_be_created_for_disapproved_question()
    {

        $question = Question::factory()
            ->exam()
            ->disapproved()
            ->create(['questionable_id' => $this->exam->id]);

        $answer = Answer::factory()->raw();

        $question->giveAnswer($answer);

        $this->assertCount(0, $question->answers);
    }

    /**
     *@test
     **/
    public function answer_can_be_created_for_approved_question()
    {

        $question = Question::factory()
            ->exam()
            ->approved()
            ->create(['questionable_id' => $this->exam->id]);

        $answer = Answer::factory()->raw();

        $question->giveAnswer($answer);

        $this->assertCount(1, $question->answers);
    }
}
