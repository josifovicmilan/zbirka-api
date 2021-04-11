<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function addQuestion(Question $question)
    {
        return $this->questions()->attach($question);
    }
}
