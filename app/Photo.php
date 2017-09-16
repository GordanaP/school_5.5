<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Photo extends Model
{
    protected $fillable = ['name', 'path', 'thumbnail_path'];

    protected $lessonsImagesDir = 'images/lessons';

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    protected static function makePhoto($file, $user)
    {
        $photo = new static;

        $photo->saveAs($file->getClientOriginalName(), $user);

        $photo->move($file, $user);

        return $photo;
    }

    protected function saveAs($name, $user)
    {
        $this->name = $name;
        $this->path = $this->filepath($user). '/' .$name;
        $this->thumbnail_path = $this->filepath($user). '/tn-' .$name;

        return $this;
    }

    protected function move($file, $user)
    {
        $file->move($this->filepath($user), $this->name);

        $this->makeThumbnail();
    }

    protected function makeThumbnail()
    {
        Image::make($this->path)            // get from path
            ->fit(200)                      // customize
            ->save($this->thumbnail_path);  // save to path
    }

    protected function filepath($user)
    {
        return $this->lessonsImagesDir. '/' .$user->name;
    }

}
