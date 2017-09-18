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

    @include('flash::message')

    <article class="lesson bg-white  border-light-grey">

        <!-- Lesson title -->
        <header class="lesson__title pd-30 grayscale-20">
            <h1 class="flex align-center ls-1" style="font-family: Lato">
                <img src="{{ asset('images/icons/calculating.svg') }}" alt="" width="7%" class="mr-24">
                <div class="mr-24">
                    <span>{{ $lesson->title }}</span>
                </div>
            </h1>
        </header>

        <section class="lesson__content pd-30" style="padding-right: 60px">
            <!-- Lesson ratings -->
            <p class="lesson__ratings text-secondary mb-30">
                <a href="#" style="color: #cc8b00"><i class="fa fa-star"></i></a>
                <a href="#" style="color: #cc8b00"><i class="fa fa-star"></i></a>
                <a href="#" style="color: #cc8b00"><i class="fa fa-star"></i></a>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </p>

            <div class="row">
                <main class="col-md-8 pl-30">
                    <!-- Topic -->
                    <h4 class="mb-30">Topic</h4>
                    <p class="lh-18 text-light-grey">{{ $lesson->topic }}</p>

                    <hr class="mt-30 mr-30">

                    <!-- Objectives -->
                    <h4 class="mb-30 mt-30">Learning objectives</h4>
                    <p class="lh-18 text-light-grey mr-30">{{ $lesson->goals }}</p>

                    <hr class="mt-30 mb-30">

                    <!-- Readings -->
                    <p class="text-uppercase ls-1 "><b>Readings</b></p>
                    @foreach ($lesson->readings as $reading)
                        <p class="mt-6 text-secondary">{{ $reading->title }}</p>
                    @endforeach

                    <!-- Media -->
                    <p class="text-uppercase ls-1 mt-30"><b>Media</b></p>
                    <p class="mt-6">
                        <a href="https://www.youtube.com/watch?v=QIU_UbkPnaU">
                            How to sqaure any 2 digit number in your head
                        </a>
                    </p>
                </main>

                <aside class="col-md-4" style="border: 1px solid #f0c975; border-top-width: 6px;">
                    <div class="text-center">
                        <img src="{{ asset('images/icons/teacher.jpg') }}" alt="" class="mb-24 mt-24 img-circle">
                    </div>
                    <div style="padding: 24px 12px">
                        <p><b>Subject:</b> <span class="ml-6" style="font-family: Gabriela">{{ $lesson->subject->name }}</span></p>
                        <p class="mt-12"><b class="mr-6">Year:</b> {{ $lesson->year }}</p>
                        <p class="mt-12"><b class="mr-6">Teacher:</b> {{ $lesson->teacher->first_name }}</p>
                    </div>
                </aside>
            </div>

            <!-- Photos -->
            <footer class="lesson__photos row mt-30">
                @foreach ($lesson->photos->chunk(4) as $chunk)
                    @foreach ($chunk as $photo)
                        <div class="col-md-3">

                            @include('lessons.photos._photo')

                        </div>
                    @endforeach
                @endforeach
            </footer>

        </section><!-- lesson__content -->
    </article><!-- lesson -->

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