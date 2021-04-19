<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     **/
    public function comment_can_belong_to_a_question()
    {

        $exam = Exam::factory()->create();
        $question = Question::factory()
            ->exam()
            ->approved()
            ->create(['questionable_id' => $exam->id]);

        $comment = Comment::create([
            'body' => 'Najbolji komentar',
            'commentable_id' => $question->id,
            'commentable_type' => Question::class,
        ]);


        $this->assertCount(1, $question->comments()->get());
    }

    /**
     *@test
     **/
    public function comment_can_belong_to_answer()
    {
        $exam = Exam::factory()->create();
        $question = Question::factory()
            ->exam()
            ->approved()
            ->create(['questionable_id' => $exam->id]);

        $answer = Answer::factory()->create(['questionable_id' => $question->id]);
        $comment = Comment::create([
            'body' => 'Najbolji komentar',
            'commentable_id' => $answer->id,
            'commentable_type' => Answer::class,
        ]);
        // $answer->makeComment($comment);

        $this->assertCount(1, $answer->comments()->get());
    }

    /**
     *@test
     **/
    public function comment_can_be_created_for_a_question()
    {

        $exam = Exam::factory()->create();
        $question = Question::factory()
            ->exam()
            ->approved()
            ->create(['questionable_id' => $exam->id]);

        $comment = Comment::factory()->raw([
            'body' => 'Najbolji komentar',
        ]);

        $question->giveComment($comment);

        $this->assertCount(1, $question->comments()->get());
    }

    /**
     *@test
     **/
    public function comment_can_be_created_for_an_answer()
    {

        $exam = Exam::factory()->create();
        $question = Question::factory()
            ->exam()
            ->approved()
            ->create(['questionable_id' => $exam->id]);

        $answer = Answer::factory()->create(['questionable_id' => $question->id]);
        $comment = Comment::factory()->raw([
            'body' => 'Najbolji komentar',
        ]);

        $answer->giveComment($comment);

        $this->assertCount(1, $answer->comments()->get());
    }
}
