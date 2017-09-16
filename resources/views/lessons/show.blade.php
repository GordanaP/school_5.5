@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.css" />
@endsection

@section('title', '| ' . $lesson->title)

@section('content')
    <div class="row">
        <div class="col-md-3">
            sidebar
        </div>
        <div class="col-md-9 lesson__photos">

            @include('errors._list')

            {{ $lesson->title }}

            <form class="dropzone" action="{{ route('lessons.photos', [$user, $lesson]) }}" method="POST" id="addLessonPhotosForm">

                {{ csrf_field() }}

            </form>

            <div class="row lesson__photos-display">
                @foreach ($lesson->photos as $photo)
                    <div class="col-md-3">
                        <img src="{{ asset($photo->path) }}" alt="" class="image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.js"></script>

    <script>
        Dropzone.options.addLessonPhotosForm = {
            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp, .gif',
        }
    </script>
@endsection