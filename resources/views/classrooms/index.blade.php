@extends('layouts.app')

@section('title', '| My classrooms')

@section('links')
    <style>
        div.collapse-panel .panel-heading{
            padding: 15px;
            background: #f1f1f1;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%236b9b37' fill-opacity='0.4' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");}
        div.collapse-panel .panel-heading .panel-title a{color: #777; font-weight: bold}
        div#accordion.panel-group{margin-bottom: 0;}
    </style>
@endsection

@section('content')

    <main class="lecture">

        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i> My classrooms
        </h1>

        <hr>

        <div class="wrapper">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach ($user->teacher->subjects->unique() as $subject)
                    <div class="panel panel-default collapse-panel">
                        <div class="panel-heading" role="tab" id="heading{{ $subject->id }}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $subject->id }}" aria-expanded="true" aria-controls="collapse{{ $subject->id }}">
                                    {{ ucwords($subject->name) }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $subject->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $subject->id }}">
                            <div class="list-group">
                                @foreach ($user->teacher->teacherSubjects($subject->id) as $subject)
                                    <div class="list-group-item">
                                        <div class="flex justify-between align-center">
                                            {{ $classroom = \App\Classroom::whereId($subject->pivot->classroom_id)->first()->label }}
                                            <div class="pull-right">
                                                <a href="{{ route('classrooms.show', [$user, $classroom ,$subject]) }}" class="btn btn-info">
                                                    Gradebook
                                                </a>
                                                <a href="#" class="btn btn-warning">Attendance</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </main>

@endsection