@extends('layouts.app')

@section('content')

    <div class="row">
        <aside class="col-md-3">
            <ul>
                <li><a href="#">My portfolio</a></li>
            </ul>
        </aside>

        <main class="col-md-9 lecture">
            <div class="wrapper">
                <form action="{{ route('lessons.store', $user) }}" method="POST" class="form-horizontal">

                    {{ csrf_field() }}

                    <section class="lecture__title">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <div class="form-group" id="subject">
                                        <label for="subject_id">Subject <span class="asterisk">*</span></label>
                                        <select class="form-control" name="subject_id" id="subject_id">
                                            <option selected="" disabled="">Select a subject</option>
                                            @foreach ($user->teacher->subjects->unique() as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ selected($subject->id, old('subject_id')) }}
                                                >
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group" id="year">
                                        <label for="year">Academic year <span class="asterisk">*</span></label>
                                        <select class="form-control" name="year" id="year">
                                            <option selected="" disabled="">Select a year</option>
                                            @foreach (Year::all() as $year => $name)
                                                <option value="{{ $year }}"
                                                    {{ selected($year, old('year')) }}
                                                >
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="lecture__info" id="general">
                        <div class="panel">
                            <div class="panel-heading text-uppercase ls-2">
                                General
                            </div>
                            <div class="panel-body">
                                <p class="required__fields">Fields marked with * are required.</p>
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">Title <span class="asterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Lesson title">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="topic" class="col-sm-2 control-label">Topic <span class="asterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="topic" id="topic" value="{{ old('topic') }}" placeholder="Lesson topic">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="goals" class="col-sm-2 control-label">Goals <span class="asterisk">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="goals" id="goals" rows="4" placeholder="Lesson goals">{{ old('goals') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default pull-right" style="margin-right: 15px;">
                                Create lecture
                            </button>
                        </div>
                    </section>
                </form>
            </div>
        </main>
    </div>

@endsection