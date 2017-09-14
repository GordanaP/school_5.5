@extends('layouts.app')

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
                <form action="{{ route('lessons.store', $user) }}" method="POST">

                    {{ csrf_field() }}

                    @include('lessons.partials._createForm', [
                        'subject_id' => old('subject_id'),
                        'year' => old('year'),
                        'title' => old('title'),
                        'topic' => old('topic'),
                        'goals' => old('goals'),
                        'readings' => old('readings'),
                        'button' => 'Create lesson',
                    ])

                </form>
            </div>
        </main>
    </div>

@endsection

@section('scripts')
    @include('lessons.partials._createFormJs')
@endsection