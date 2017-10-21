@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.css') }}
@endsection

@section('content')

    <p class="text-center">
        <button class="btn btn-default" data-toggle="modal" data-target="#eventModal">Login</button>
    </p>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog">
            <form id="eventForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Login</h5>
                    </div>

                    <div class="modal-body">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon_star_alt"></i></span>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter event title">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter event description">
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon_pushpin_alt"></i></span>
                                <select class="form-control" name="subject_id" id="subject_id">
                                    <option value="" selected="" disabled="">Select a subject</option>
                                        @foreach ($user->subjects_unique as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ ucwords($subject->name) }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Classroom -->
                        <div class="form-group">
                            <label for="classroom">Classroom</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                <select class="form-control" name="classroom_id" id="classroom_id">
                                    <option value="" selected="" disabled="">Select a classroom</option>
                                    {{-- @foreach ($user->teacher->subjects as $subj)
                                        <option value="{{ $subj->pivot->classroom_id }}">
                                            {{ \App\Classroom::where('id', $subj->pivot->classroom_id)->first()->label }}
                                        </option>
                                    @endforeach --}}
                                    <!-- Options for the selected subject only by using an ajax call -->
                                </select>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            <label for="date">Date</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="eventDate" id="eventDate" placeholder="YYYY-MM-DD">
                            </div>
                        </div>

                        <div class="row">
                            <!-- Start-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">Start</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" class="form-control" name="start" id="start" placeholder="hh:mm">
                                    </div>
                                </div>
                            </div>

                            <!-- End -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end">End</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" class="form-control" name="end" id="end" placeholder="hh:mm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left close-button" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-default cancel-button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary event-button" id="storeEvent">Create event</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/moment-2.18.1/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.js') }}"></script>


    <script>

        // Helper js function
        @include('events.js._helpers')

        // Timepicker - set time format, min & max time, min time interval
        @include('events.js._timepicker')

        var eventDate = "YYYY-MM-DD";
        var eventTime = "HH:mm";

        var userName = "{{ $user->name }}";
        var baseUrl = '../calendar/' + userName; // EventController@index

        @include('classrooms.js._subjectClassroomsJs')

        $(".modal").on("hidden.bs.modal", function() {
            $("input, select#subject_id, select#classroom_id, data-event").val("").end();
            $('#eventForm').formValidation('resetForm', true);
        });

        $('#eventDate').datepicker({
            dateFormat: "yy-mm-dd", // 2017-09-27
            minDate: 0, // today
            changeMonth: true,
            changeYear: true,
            firstDay: 1, // Monday,
            beforeShowDay: function(date) // disable and mark in red Sundays & holidays
            {
                var day = date.getDay();
                var year = date.getFullYear();
                var formattedDate = jQuery.datepicker.formatDate('yy-mm-dd', date);

                var January1 = year + "-01-01";
                var January2 = year + "-01-02";
                var January7 = year + "-01-07";
                var February15 = year + "-02-15";
                var February16 = year + "-02-16";
                var May1 = year + "-05-01";
                var May2 = year + "-05-02";
                var November11 = year + "-11-11";
                var GoodFriday = orthodoxEasterSunday(year).subtract(2, 'd').format(eventDate);
                var EasterMonday = orthodoxEasterSunday(year).add(1, 'd').format(eventDate);

                var holidays = [January1, January2, January7, February15, February16, May1, May2, November11, GoodFriday, EasterMonday];

                // Sundays
                if (day == 0)
                {
                    // false = nonselectable field, markholiday = css class
                    return [false, "markholiday"];
                }
                else
                {
                    // returns -1 if the value is not in the array, otherways returns the value of the index
                    return (holidays.indexOf(formattedDate) == -1) ? [true] : [false, "markholiday"];
                }
            },
            onSelect: function(date, inst) {
                /* Revalidate the field when choosing it from the datepicker */
                $('#eventForm').formValidation('revalidateField', 'eventDate');
            }
        })  // revalidate on select a date using datepiacker

        $('#eventForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The title is required'
                        }
                    }
                },
                subject_id: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required'
                        }
                    }
                },
                classroom_id: {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required'
                        }
                    }
                },
                eventDate: {
                    validators: {
                        notEmpty: {
                            message: 'The date is required'
                        },
                        date: {
                            format: eventDate,
                            message: 'The date format is not valid'
                        },
                    }
                },
                start: {
                    validators: {
                        notEmpty: {
                            message: 'The start is required'
                        }
                    }
                },
                end: {
                    validators: {
                        notEmpty: {
                            message: 'The end is required'
                        }
                    }
                },
            }
        })
        .on('success.validator.fv', function(e, data) {
            if (data.field === 'eventDate' && data.validator === 'date' && data.result.date)
            {
                // The eventDate field passes the date validator,
                var currentDate = moment(data.result.date, eventDate, true);

                // The selected date is Sunday
                if (! isNotSunday(currentDate)) {
                    // Treat the field as invalid
                    data.fv
                        .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
                        .updateMessage(data.field, data.validator, 'Please choose a day except Sunday');
                }

                // The selected date is holiday
                if (! isNotHoliday(currentDate)) {
                    // Treat the field as invalid
                    data.fv
                        .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
                        .updateMessage(data.field, data.validator, 'Please choose a day except national holiday');
                }

                // The selected date is in the past
                if (currentDate.isBefore(today()))
                {
                    data.fv
                    .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
                    .updateMessage(data.field, data.validator, 'Please choose a day after today');
                }

                // The selected date is after the max date
                if (currentDate.isAfter(schoolYearEnd()))
                {
                    data.fv
                        .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
                        .updateMessage(data.field, data.validator, 'Please choose a day before 2017-08-31');
                }
            }
        })
        .on('success.form.fv', function(e) {

            e.preventDefault();

            // The modal fields' values
            var title = $('#title').val();
            var description = $('#description').val();
            var subjectId = $('#subject_id').val();
            var classroomId = $('#classroom_id').val();
            var date = $('#eventDate').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var startTime = date + ' ' + start;
            var endTime = date + ' ' + end;

            // Create a new event object
            event = {
                title: title,
                description: description,
                subject_id: subjectId,
                classroom_id: classroomId,
                start: startTime,
                end: endTime,
            }

            // Store the event in DB
            $.ajax({
                url: baseUrl,
                type: 'POST',
                data: event,
                success: function(response){
                    $('#eventModal').modal('hide');
                    console.log(response.message);
                }
            });
        });

    </script>

@endsection