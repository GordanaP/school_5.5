<?php

namespace App;

use App\Observers\LessonObserver;
use App\Traits\LessonCreate;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use LessonCreate;

    protected $fillable = ['subject_id', 'year', 'title', 'topic', 'goals'];

    protected static function boot()
    {
        parent::boot();

        static::observe(LessonObserver::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function readings()
    {
        return $this->hasMany(Reading::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
