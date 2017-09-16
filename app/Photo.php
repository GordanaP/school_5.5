<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path', 'teacher_id'];

    protected $lessonsImagesDir = 'images/lessons/';

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public static function new($file, $user, $lesson)
    {
        // New instance
        $photo = new static;

        // Move file to the location
        $filename = $file->getClientOriginalName();
        $filepath = $photo->lessonsImagesDir .$user->name .'/'.$lesson->subject->name .'/'.$lesson->id;

        $file->move($filepath, $filename);

        // Create new photo
        $path = $filepath.'/'.$filename;

        $photo->path = $path;

        return $photo;
    }

}
