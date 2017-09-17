<?php

namespace App;

use App\Observers\PhotoObserver;
use Illuminate\Database\Eloquent\Model;
use Image;

class Photo extends Model
{
    /**
     * Fillable fields for a photo
     *
     * @var [array]
     */
    protected $fillable = ['name', 'path', 'thumbnail_path'];

    /**
     * The uploaded file instance
     *
     * @var [string]
     */
    protected $file;

    /**
     * The user instance
     *
     * @var [string]
     */
    protected $user;

    /**
     * The base directory for lessons photos
     *
     * @var string
     */
    protected $lessonsPhotosDir = 'images/lessons';

    /**
     * Model boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Upload the file to the location
        static::observe(PhotoObserver::class);
    }


    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }


    /**
     * Make a new photo instance for the file uploaded by the user
     *
     * @param $file [file]
     * @param $file [string]
     * @return self
     */
    protected static function makePhoto($file, $user) // static constructor
    {
        $photo = new static; // instantiate a photo

        $photo->user = $user;  // set the user instance
        $photo->file = $file;  // set the file instance

        $photo->fill([  // set the file properties
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);

        return $photo;
    }

    /**
     * Get the file name for the photo
     *
     * @return string
     */
    protected function fileName()
    {
        return $this->file->getClientOriginalName();
    }

    /**
     * Get the path to the photo
     *
     * @return string
     */
    protected function filePath()
    {
        return $this->fileLocation() .'/' .$this->fileName();
    }

    /**
     * Get the path to the thumbnail
     *
     * @return string
     */
    protected function thumbnailPath()
    {
        return $this->fileLocation() .'/tn-' .$this->fileName();
    }

    /**
     *  Get the file location
     *
     * @return string
     */
    protected function fileLocation()
    {
        return $this->lessonsPhotosDir. '/' .$this->user->name;
    }

    /**
     * Create a thumbnail for the photo.
     *
     * @return void
     */
    protected function makeThumbnail()
    {
        Image::make($this->filePath())             // get from path
            ->fit(200)                                  // customize
            ->save($this->thumbnailPath());        // save to path
    }

    /**
     * Move the photo to the proper location
     *
     * @return self
     */
    public function upload()
    {
        $this->file->move($this->fileLocation(), $this->fileName());

        $this->makeThumbnail();

        return $this;
    }
}
