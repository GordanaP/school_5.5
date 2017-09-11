<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['label'];

    public function getRouteKeyName()
    {
        return 'label';
    }
}
