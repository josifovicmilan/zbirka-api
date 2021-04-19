<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     **/
    public function display_all_books()
    {

        $books = Book::factory()->count(2)->create();

        $response = $this->getJson('api/books');

        $response->assertJsonStructure([
            '*' => [
                'title',
                'author',
                'file',
                'cover',
            ]
        ]);
    }
    /**
     *@test
     **/
    public function unauthorized_user_cannot_create_new_book()
    {

        $book = Book::factory()->raw();

        $this->postJson('/api/books', $book)->assertStatus(401);
    }

    /**
     *@test
     **/
    public function regular_user_cannot_create_new_book()
    {
    }

    /**
     *@test
     **/
    public function paid_user_cannot_create_new_book()
    {
    }
}
