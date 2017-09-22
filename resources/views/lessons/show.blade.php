@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.css" />
    <link rel="stylesheet" href="{{ asset('vendor/lightbox2/dist/css/lightbox.min.css') }}">

    <style>
        button.lesson__photos-remove{position: absolute; background: #cfff95;}
    </style>
@endsection

@section('title', '| ' . $lesson->title)

@section('content')

    <div class="row">

        @include('flash::message')

    <article class="row lesson">

        @include('lessons.partials._lesson')

    </article>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.js"></script>
    <script src="{{ asset('vendor/lightbox2/dist/js/lightbox.min.js') }}"></script>

    <script>
        // The max # of files/lesson and the remaining # of files allowed
        var maxFilesPerLesson = 4;
        var lessonFilesCount = $('#addLessonPhotosForm').attr('data-count');
        var maxFilesRemained = maxFilesPerLesson - lessonFilesCount;

        Dropzone.options.addLessonPhotosForm = {
            addRemoveLinks:true,
            paramName: 'photo', // change default input name
            maxFiles: maxFilesRemained,
            dictMaxFilesExceeded:  "Maximum upload limit reached",
            accept: function(file, done) {
                console.log("uploaded");
                done();
            },
            init: function() {
                this.on("maxfilesexceeded", function(){
                    if(lessonFilesCount == 0)
                    {
                      alert('Only four files per lesson are allowed.');
                    }
                    else{
                        alert("The remaining number of the allowed files for this lesson is " + maxFilesRemained + ".");
                    }
                });
            },
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif',
            success: function(file, response) {
                if (file.status == 'success') {

                    fileUpload.handleSuccess(response);
                }
                else{

                    fileUpload.handleError(response);
                }
            }
        }//Dropzone

         var fileUpload = {
             handleSuccess: function(response){
                 console.log(response);

                 var gallery = $('.lesson__photos ul');
                 var baseUrl = 'http://localhost/school_5.5/public/';
                 var photoPath = response.path;
                 var thumbnailPath = response.thumbnail_path;
                 $(gallery).append('<li class="col-md-3"><a href="'+ baseUrl + photoPath + '" data-lightbox="' + response.lesson_id + '" data-title="My caption"><img src="' + baseUrl + thumbnailPath + '" class="image"></a></li>');
             },
             handleError: function(response){

             }
         }

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })// Lightbox

    </script>
@endsection