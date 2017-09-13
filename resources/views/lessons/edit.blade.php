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
                <form action="{{ route('lessons.update', [$user, $lesson] ) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <section class="lecture__title">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" id="subject">
                                    <label for="subject_id">Subject <span class="asterisk">*</span></label>
                                    <select class="form-control" name="subject_id" id="subject_id">
                                        <option selected="" disabled="">Select a subject</option>
                                        @foreach ($user->teacher->subjects->unique() as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ selected($subject->id, $lesson->subject_id) }}
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
                                                {{ selected($year, $lesson->year) }}
                                            >
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="lecture__info" id="general">
                        <div class="panel">
                            <div class="panel-heading text-uppercase ls-1">
                                General
                            </div>
                            <div class="panel-body">
                                <p class="required__fields">Fields marked with * are required.</p>
                                <div class="form-group">
                                    <label for="title">Title <span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $lesson->title }}" placeholder="Lesson title">
                                </div>

                                <div class="form-group">
                                    <label for="topic">Topic</label>
                                    <input type="text" class="form-control" name="topic" id="topic" value="{{ $lesson->topic }}" placeholder="Lesson topic">
                                </div>

                                <div class="form-group">
                                    <label for="goals">Goals</label>
                                    <textarea class="form-control" name="goals" id="goals" rows="4" placeholder="Lesson goals">{{ $lesson->goals }}</textarea>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="lecture__info" id="materials">
                        <div class="panel">
                            <div class="panel-heading text-uppercase ls-1">
                                Materials
                            </div>
                            <div class="panel-body">

                                <div class="input_fields_wrap">
                                    <div class="form-group">
                                        <label for="readings">Readings</label>
                                        @foreach ($lesson->readings as $reading)
                                            <div class="flex align-center">
                                                <input type="text" class="form-control" name="readings[]" value="{{ $reading->title }}" placeholder="Readings"/><a href="#" class="remove_field ml-10" >Remove</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="add_field_button">Add More Fields</button>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default pull-right create__button" >
                                Save changes
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </section>
                </form>
            </div>
        </main>
    </div>

@endsection

@section('scripts')
    <script>
        var max_fields = 3; //maximum fields allowed
        var wrapper = $(".input_fields_wrap"); //fields wrapper
        var add_button = $(".add_field_button"); // add button

        var x = 0; //initial fields count

        if($('input[name="readings[]').length >= max_fields){
           $(".add_field_button").hide();
        }

        // Add input field
        $(add_button).click(function(e){
            e.preventDefault();

            if(x < (max_fields)){
                x++;
                $(wrapper).append('<div class="flex align-center"><input type="text" class="form-control" name="readings[]" placeholder="Readings"/><a href="#" class="remove_field ml-10" >Remove</a></div>');
            }
        });

        //Remove input field
        $(wrapper).on("click",".remove_field", function(e){
            e.preventDefault();

            $(this).parent('div').remove();
            x--;
        })
    </script>
@endsection