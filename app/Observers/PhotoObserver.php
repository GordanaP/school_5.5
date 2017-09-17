<?php

namespace App\Observers;

use App\Photo;

class PhotoObserver
{
    public function creating(Photo $photo)
    {
        $photo->upload();
    }
}