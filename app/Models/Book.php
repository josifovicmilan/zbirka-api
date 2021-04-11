<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    public function addQuestion(Question $question)
    {
        return $this->questions()->save($question);
    }
}
