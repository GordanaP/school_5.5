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
                <form action="{{ route('lessons.update', [$user, $lesson] ) }}" method="POST">

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