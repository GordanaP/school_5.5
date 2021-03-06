<?php

namespace App;

use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['first_name', 'last_name', 'gender', 'parent', 'dob', 'birthplace', 'about'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('classroom_id', 'year');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('subject_id', 'desc')->orderBy('year');
    }

    public function photos()
    {
        return $this->hasManyThrough('App\Photo', 'App\Lesson');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' .ucfirst($this->last_name);
    }

    public function teacherSubjects($subject_id)
    {
       return $this->subjects()->where('subject_id', $subject_id)->get();
    }

    public function subjects_unique()
    {
        return optional($this->subjects)->unique();
    }

    public function owns($model)
    {
        return $this->id === $model->teacher_id;
    }
}
