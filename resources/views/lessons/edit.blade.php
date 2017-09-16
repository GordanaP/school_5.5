@extends('layouts.app')

@section('title', '| '. $lesson->title . ' | Edit')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
@endsection


@section('content')

    <div class="row">
        <aside class="col-md-3">
            <ul>
                <li><a href="#">My portfolio</a></li>
            </ul>
        </aside>

        <main class="col-md-9 lecture">

            @include('errors._list')
            @include('flash::message')

            <div class="wrapper">
                <form action="{{ route('lessons.update', [$user, $lesson] ) }}" method="POST" id="lessonForm">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    @include('lessons.partials._createForm', [
                        'subject_id' => $lesson->subject_id,
                        'year' => $lesson->year,
                        'title' => $lesson->title,
                        'topic' => $lesson->topic,
                        'goals' => $lesson->goals,
                        'readings' => $lesson->readings,
                        'button' => 'Save changes',
                    ])

                </form>
            </div>
        </main>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>

    @include('lessons.partials._validateFormJs')

    @include('lessons.partials._createFormJs')
@endsection