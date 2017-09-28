@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker/timepicker-addon.css') }}">
    {{-- <style>
        .markholiday .ui-state-default
        {
            color: red;
        }
    </style> --}}
@endsection


@section('content')

    <!-- Calendar -->
    <main class="calendar">
        <div id="eventCalendar"></div>
    </main>

    <!-- Event modal -->
    @include('events.partials._eventModal')

@endsection

@section('scripts')
    <!-- Custom JS with CXRF protection -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>
    <script src="{{ asset('vendor/timepicker/timepicker-addon.js') }}"></script>

    <script>

        // Empty modal fields content after closing it
        $(".modal").on("hidden.bs.modal", function() {
            $("input, textarea, select").val("").end();
        });


        var calendar = $('#eventCalendar');
        var user = $('.event__button').attr('data-user');
        var base_url = '../calendar/' + user;

        calendar.fullCalendar({
            header: {
                left: 'prev,next today newEvent',
                center: 'title',
                right: 'month, agendaWeek, agendaDay, list'
            },
            defaultView: 'month',
            handleWindowResize: true,
            displayEventTime: false,
            showNonCurrentDates: false,
            slotDuration: '00:15:00',
            firstDay: 1,
            navLinks: true,
            editable: true,
            selectable: true,
            selectHelper: true,
            businessHours: [
                {
                    dow: [ 1, 2, 3, 4, 5, 6 ],
                    start: '08:00:00',
                    end: '20:00:00'
                }
            ],
            eventLimit: true,
            eventSources: [ // Calendar events stored in DB
                {
                    url : base_url // EventController@index - renders events
                }
            ],
            // When selecting a fullcalendar field - display a BS modal to create a new event
            select: function(start, event, jsEvent, view){

                // Open the event modal only from today on and by authorized users
                var selectedDate = start.format("YYYY-MM-DD");
                var today = moment().format("YYYY-MM-DD");

                if(selectedDate >= today)
                {
                    if( Laravel.user.role.teacher || Laravel.user.role.admin || Laravel.user.role.superadmin)
                    {
                        $('#eventModal').modal('show');
                    }
                }
                else
                {
                    alert('You can not create an event in the past.');
                }

                // Set the modal parameters
                $('.modal-title span').text('New event'); // Add title
                $('.modal-title i').addClass('fa-pencil'); // Add class to the title icon
                $('.modal .event__button').text('Create event'); // Add text to the button
                $('.modal .event__button').attr('id', 'storeEvent'); // Add id to the button

                // Set the date & times input fields value by using momentjs
                start = moment(start.format());
                $('#date').val(start.format('YYYY-MM-DD'));
                $('#start').val(start.format('HH:mm'));
                $('#end').val(start.format('HH:mm'));
            },
            // On clicking an existing event - display modal to edit the event
            eventClick: function(event, jsEvent, view)
            {
                $('#eventModal').modal('show'); // Open the modal
                $('.modal-title span').text('Edit event'); // Add title
                $('.modal-title i').addClass('fa-pencil-square-o'); // Add class to the title icon
                $('.modal .event__button').text('Save changes'); // Add text to the button
                $('.modal .event__button').attr('id', 'updateEvent'); // Add id to the button
            }
        });

        // Filter the classrooms for the selected subject only
        @include('classrooms.js._subjectClassroomsJs')

        // Datepicker - set maxdate, disable SUndays & holidays
        @include('events.js._datepicker')

        // Timepicker - set time format, min & max time, min time interval
        @include('events.js._timepicker')


    </script>
@endsection
