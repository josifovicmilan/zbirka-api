<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'questionables';

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'questionable_id');
    }

    public function giveAnswer($answer)
    {

        if (!$this->approved) {
            return;
        }
        $this->answers()->create([
            'approved' => false,
            'text' => $answer['text']
        ]);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function ratings()
    {

        return $this->morphMany(Rate::class, 'rateable');
    }

    public function rate($star)
    {

        return $this->ratings()->create([
            'rateable_type' => Question::class,
            'rateable_id' => $this->id,
            'star' => $star
        ]);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function giveComment($comment)
    {
        return $this->comments()->create([
            'commentable_id' => $this->id,
            'commentable_type' => static::class,
            'body' => $comment['body']
        ]);
    }
}
