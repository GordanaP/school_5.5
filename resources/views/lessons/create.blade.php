@extends('layouts.app')

@section('title', '| New lesson')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
@endsection

@section('content')

    <main class="lecture">

        @include('errors._list')
        @include('flash::message')

        <h1><i class="fa fa-pencil"></i> New lesson</h1>

        <hr>

        <div class="wrapper">
            <form action="{{ route('lessons.store', $user) }}" method="POST" id="lessonForm">

                {{ csrf_field() }}

                @include('lessons.partials._lessonForm', [
                    'subject_id' => old('subject_id'),
                    'year' => old('year'),
                    'title' => old('title'),
                    'topic' => old('topic'),
                    'goals' => old('goals'),
                    'readings' => old('readings'),
                    'readings_array' => old('readings'),
                    'max_field_num' => 3,
                    'button' => 'Create lesson',
                ])

            </form>
        </div>

    </main>

@endsection

@section('scripts')

    <!-- Custom JS with CXRF protection -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <!-- Different from original BS file -->
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>

    <script>

        var lessonForm = $('#lessonForm'),
            subject = $('#subject_id'),
            year = $('#year');

        // Get year options dynamically
        subject.on('change', function(e)
        {
            var subjectId = e.target.value;
            var teacherSubjectYearUrl = '../../subjects/' + "{{ $user->name }}" + '/' + subjectId;

            $.ajax({
                url: teacherSubjectYearUrl,
                type: 'GET',
                success: function(response){
                    year.html(response);
                }
            });
        })

    </script>

    <script>

        @include('lessons.js._validateJs')

    </script>


@endsection