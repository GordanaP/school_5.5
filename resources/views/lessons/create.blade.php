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

                    @include('lessons.partials._createForm', [
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
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>

    @include('lessons.partials._validateFormJs')

@endsection