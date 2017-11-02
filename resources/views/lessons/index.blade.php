@extends('layouts.app')

@section('title', '| My lessons')

@section('links')
    <style>
        table.lesson__table {font-size: 12px}
    </style>
@endsection

@section('content')

    <h1>My lessons</h1>

    @include('flash::message')

    @if (count($lessons))
        <table class="table table-striped lesson__table">
            <thead>
                <th width="150px">Subject</th>
                <th width="150px">Year</th>
                <th>Title</th>
                <th>Topic</th>
                <th><i class="fa fa-cog" aria-hidden="true"></i></th>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->subject->name }}</td>
                        <td>{{ $lesson->year }}</td>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->topic }}</td>
                        <td class="flex">
                            <a href="{{ route('lessons.edit', [$user, $lesson] ) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <form action="{{ route('lessons.destroy', [$user, $lesson]) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                            <a href="{{ route('lessons.show', [$user, $lesson]) }}">
                                <i class="fa fa-eye ml-10" style="color: #aaa"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        No lessons yet.
    @endif

@endsection