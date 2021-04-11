<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Rate;
use App\Models\Step;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    protected $exam;
    protected function setUp(): void
    {
        parent::setUp();
        $this->exam = Exam::factory()->create();
    }
    /**
     *@test
     **/
    public function answer_can_be_approved()
    {
        $question = Question::factory()->exam()->disapproved()->create(['questionable_id' => $this->exam->id]);
        $answer = Answer::factory()->disapproved()->create(['questionable_id' => $question->id]);


        $this->assertEquals(false, $answer->approved);

        $answer->approve();

        $this->assertEquals(true, $answer->fresh()->approved);
    }


    /**
     *@test
     **/
    public function answer_can_be_rated()
    {

        $question = Question::factory()
            ->exam()
            ->approved()
            ->create(['questionable_id' => $this->exam->id]);
        $answer = Answer::factory()->create(['questionable_id' => $question->id]);

        $answer->rate(5);

        $this->assertCount(1, $answer->ratings()->get());
    }

    /**
     *@test
     **/
    public function answer_can_have_many_steps()
    {

        $question = Question::factory()->approved()->exam()->create(['questionable_id' => $this->exam->id]);
        $answer = Answer::factory()->create(['questionable_id' => $question->id]);

        $step = Step::create([
            'text' => 'saberi te brojeve',
            'answer_id' => $answer->id
        ]);

        $this->assertCount(1, $answer->steps()->get());
    }
}
