<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = ['title', 'start', 'end', 'allDay', 'holiday'];

    public $timestamps = false;
}
