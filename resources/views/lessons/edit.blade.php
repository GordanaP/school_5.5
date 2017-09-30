@extends('layouts.app')

@section('title', '| '. $lesson->title . ' | Edit')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
@endsection


@section('content')

    <main class="lecture">

        @include('errors._list')
        @include('flash::message')

        <h1><i class="fa fa-pencil-square-o"></i> Edit lesson</h1>

        <hr>

        <div class="wrapper">
            <form action="{{ route('lessons.update', [$user, $lesson] ) }}" method="POST" id="lessonForm">

                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @include('lessons.partials._lessonForm', [
                    'subject_id' => $lesson->subject_id,
                    'year' => $lesson->year,
                    'title' => $lesson->title,
                    'topic' => $lesson->topic,
                    'goals' => $lesson->goals,
                    'readings' => $lesson->readings,
                    'readings_array' => ' ',
                    'max_field_num' => 3,
                    'button' => 'Save changes',
                ])

            </form>
        </div>
    </main>

@endsection

@section('scripts')

    <!-- Custom JS with CXRF protection -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>

    <script>

        @include('lessons.js._validateJs')

    </script>

@endsection