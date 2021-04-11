<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'rateables';


    public function rateable()
    {
        return $this->morphTo();
    }
}
