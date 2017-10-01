@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker/timepicker-addon.css') }}">
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
        var user = $('.event__button').attr('data-user'); // $user->name
        var base_url = '../calendar/' + user; // EventController@index

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
            eventSources: [
                {
                    url : base_url  // renders events
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
                $('#start').val(start.format('08:00'));
                $('#end').val(start.format('08:45'));
            },
            // On clicking an existing event - display the modal to edit the existing event
            eventClick: function(event, jsEvent, view)
            {
                // Open the modal to the auth user only
                if(event.teacher_id == Laravel.user.teacher_id)
                {
                    $('#eventModal').modal('show'); // Open the modal
                }

                // Handle the modal parameters
                $('.modal-title span').text('Edit event'); // Add title
                $('.modal-title i').addClass('fa-pencil-square-o'); // Add class to the title icon
                $('.modal .event__button').text('Save changes'); // Add text to the button
                $('.modal .event__button').attr('id', 'updateEvent'); // Add id to the button

                // Fetch the event form values from DB
                var date = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                var start = $.fullCalendar.moment(event.start).format('HH:mm');
                var end = $.fullCalendar.moment(event.end).format('HH:mm');

                $('#title').val(event.title);
                $('#description').val(event.description);
                $('#subject_id').val(event.subject_id);
                $('#classroom_id').val(event.classroom_id);
                $('#date').val(date);
                $('#start').val(start);
                $('#end').val(end);

                // Asssign to the button a data-event attribute containing event id for future reference
                $('button#updateEvent').attr('data-event', event.id);

            },
        });

        // Filter the classrooms for the selected subject only
        @include('classrooms.js._subjectClassroomsJs')

        // Datepicker - set maxdate, disable Sundays & holidays
        @include('events.js._datepicker')

        // Timepicker - set time format, min & max time, min time interval
        @include('events.js._timepicker')

        // Create an event - add to the calendar & store to DB
        @include('events.js._storeEvent')

        // Edit the event - save changes to the calendar & DB
        @include('events.js._updateEvent')

    </script>
@endsection
