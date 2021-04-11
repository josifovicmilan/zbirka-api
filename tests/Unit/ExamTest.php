<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     **/
    public function exam_can_have_many_questions()
    {

        $exam = Exam::create([
            'faculty_name' => 'MATF',
            'year' => 2020,
            'title' => 'Junski prijemni ispit',
            'file' => 'matf2020.pdf'
        ]);

        $question = Question::factory()->create([
            'questionable_id' => $exam->id,
            'questionable_type' => Exam::class
        ]);

        $this->assertCount(1, $exam->questions()->get());
    }
}
