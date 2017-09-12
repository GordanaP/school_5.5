<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $fillable = ['title'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
