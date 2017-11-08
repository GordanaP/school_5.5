@extends('layouts.app')

@section('links')
    <style>
        div#classroomTableWrapper {
            border: 1px solid #ddd;
            padding: 15px;
            background: #f7f7f8;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%236b9b37' fill-opacity='0.4' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
        }
    </style>
@endsection

@section('content')

    <main class="lecture">
        <h1>
            <i class="fa fa-sitemap"></i> Classroom I-1
            <a href="#" class="btn btn-default pull-right new-item" >
                Button
            </a>
        </h1>

        <hr>

        <div class="table_wrapper" id="classroomTableWrapper">
            <table class="table table-striped lesson__table" id="lessonTable">
                <thead>
                    <th>First Name</th>
                    <th>First Last</th>
                    <th>Grade</th>
                    <th>1st Test</th>
                    <th>1 Homework</th>
                    <th>Oral test</th>
                </thead>
                <tbody>
                    @if ($students)
                        @foreach ($students as $student)
                            <form action="" method="POST">
                                <tr id="student{{ $student->id }}">
                                    <td>{{ $student->name }}</td>
                                    <td>Last name</td>
                                    <td>
                                        <input type="text" name="grade" id="gradeStudent{{ $student->id }}" placeholder="Grade">
                                    </td>
                                    <td>
                                        <input type="text" name="test" id="test1" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="test" id="test2" value="">
                                    </td>
                                    <td>
                                        <input type="text" name="test" id="test3" value="">
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    @else
                        There are no students at present.
                    @endif
                </tbody>
            </table>
        </div>
    </main>

@endsection

@section('scripts')
    <script>

            var test1 = $('#test1');

            $("input").on('change', function(){
                var sum = 0;
                $("input[name=test]").each(function(){
                    sum = sum + $(this).val();
                });

                $("input[name=grade]").val(sum);
            });

            myArray =[
                [1,2,3,4],
                [1,2,3,4],
                [1,2,3,4],
                [1,2,3,4],
                [1,2,3,4],
            ];

            // var columnTotal = 0;

            // for(i=0; i<myArray.length; i++){
            //     columnTotal += myArray[i][2];
            //     console.log(columnTotal);
            // }

            var rowTotal = 0;

            for(i=0; i<myArray.length; i++){
                rowTotal += myArray[0][i];
                console.log(rowTotal);
            }

            var table = $('#lessonTable');

    </script>
@endsection