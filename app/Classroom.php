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

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public static function getLabel($classroom_id)
    {
        return static::where('id', $classroom_id)->first()->label;
    }
}
