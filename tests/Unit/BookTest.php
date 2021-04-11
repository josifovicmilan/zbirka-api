<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;


    /**
     *@test
     **/
    public function book_can_have_many_questions()
    {

        $book = Book::create([
            'title' => 'Venova zbirka',
            'author' => 'Vene',
            'file' => 'I razred.pdf'
        ]);

        $question = Question::factory()->create([
            'questionable_id' => $book->id,
            'questionable_type' => Book::class
        ]);

        $book->addQuestion($question);

        $this->assertCount(1, $book->questions()->get());
    }
}
