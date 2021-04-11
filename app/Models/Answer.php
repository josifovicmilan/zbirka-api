<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function approve()
    {

        $this->approved = true;
        $this->save();

        return $this;
    }


    public function rate($star)
    {
        return $this->ratings()->create([
            'rateable_type' => Answer::class,
            'rateable_id' => $this->id,
            'star' => $star
        ]);
    }

    public function ratings()
    {

        return $this->morphMany(Rate::class, 'rateable');
    }


    public function steps()
    {

        return $this->hasMany(Step::class);
    }
}
