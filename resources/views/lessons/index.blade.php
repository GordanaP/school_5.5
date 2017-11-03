@extends('layouts.app')

@section('title', '| My lessons')

@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <style>
        .new-item{font-family: Arial; text-transform: uppercase; font-weight: bold; letter-spacing: 0.8px; font-size: 15px; color: #777;}
    </style>
@endsection

@section('content')

    <main class="lecture">

        @include('flash::message')

        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i> My lessons
            <a href="{{ route('lessons.create', Auth::user()) }}" class="btn btn-default btn-lg pull-right new-item" >
                New lesson
            </a>
        </h1>

        <hr>

        @if (count($lessons))
            <table class="table table-striped lesson__table" id="lessonTable">
                <thead>
                    <th>Title</th>
                    <th width="120px">Subject</th>
                    <th width="50px" class="text-center">Year</th>
                    <th width="100px" class="text-center">Created</th>
                    <th width="100px" class="text-center">Last update</th>
                    <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>
                                <a href="{{ route('lessons.show', [$user, $lesson]) }}">
                                    <b>{{ $lesson->title }}</b>
                                </a>
                            </td>
                            <td>
                                {{ $lesson->subject->name }}
                            </td>
                            <td class="text-center">{{ $lesson->year }}</td>
                            <td class="text-center">{{ $lesson->created_at->format('Y-m-d') }}</td>
                            <td class="text-center">{{ $lesson->updated_at->format('Y-m-d') }}</td>
                            <td>
                                @can('access', $lesson)
                                    <div class="flex justify-center">
                                        <a href="{{ route('lessons.edit', [$user, $lesson] ) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <form action="{{ route('lessons.destroy', [$user, $lesson]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger btn-sm" style="background: #595959; border: 1px solid #595959;">
                                                <i class="fa fa-trash" aria-hidden="true" style="color: #f0ad4e"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            No lessons yet.
        @endif

    </main>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $('#lessonTable').DataTable();
    </script>

@endsection