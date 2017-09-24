<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'subject', 'classroom', 'start', 'end'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
