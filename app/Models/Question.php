<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function giveAnswer($answer)
    {

        $this->answers()->create([
            'approved' => false,
            'text' => $answer['text']
        ]);
    }
}
