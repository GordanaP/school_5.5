@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.css" />
    <link rel="stylesheet" href="{{ asset('vendor/lightbox2/dist/css/lightbox.min.css') }}">

    <style>
        button.lesson__photos-remove{position: absolute;}
    </style>
@endsection

@section('title', '| ' . $lesson->title)

@section('content')
    <div class="row">
        <div class="col-md-3">
            sidebar
            {{ $lesson->photos->count() }}
        </div>
        <div class="col-md-9 lesson__photos">

            @include('flash::message')

            {{ $lesson->title }}

            <form class="dropzone" action="{{ route('photos.store', [$user, $lesson]) }}" method="POST" id="addLessonPhotosForm" data-count="{{ $lesson->photos->count() }}">

                {{ csrf_field() }}

            </form>

            <div class="lesson__photos-display">
                @foreach ($lesson->photos->chunk(3) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $photo)
                            <div class="col-md-4">

                                <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn lesson__photos-remove">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>

                                <a href="{{ asset($photo->path) }}" data-lightbox="{{ $lesson->title }}" data-title="My caption">
                                    <img src="{{ asset($photo->thumbnail_path) }}" alt="" class="image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.js"></script>
    <script src="{{ asset('vendor/lightbox2/dist/js/lightbox.min.js') }}"></script>

    <script>

        // The max # of files/lesson and the remaining # of files allowed
        var maxFilesPerLesson = 3;
        var lessonFilesCount = $('#addLessonPhotosForm').attr('data-count');
        var maxFilesRemained = maxFilesPerLesson - lessonFilesCount;

        Dropzone.options.addLessonPhotosForm = {
            addRemoveLinks: true,
            paramName: 'photo',
            maxFiles: maxFilesRemained,
              accept: function(file, done) {
                console.log("uploaded");
                done();
              },
              init: function() {
                this.on("maxfilesexceeded", function(file){
                    if(lessonFilesCount == 0)
                    {
                        alert('Only three files per lesson are allowed.');
                    }
                    else{
                        alert("The remaining number of the allowed files for this lesson is " + maxFilesRemained + ".");
                    }
                });
            },
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif',
         }//Dropzone


        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })// Lightbox

    </script>
@endsection