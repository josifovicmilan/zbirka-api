<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;


    /**
     *@test
     **/
    public function category_can_have_many_questions()
    {

        $category = Category::create(['title' => 'Sabiranje brojeva']);
        $exam = Exam::factory()->create();

        $question = Question::factory()->exam()->create(['questionable_id' => $exam->id]);


        $category->addQuestion($question);

        $this->assertCount(1, $category->questions()->get());
    }
}
