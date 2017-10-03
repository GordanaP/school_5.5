@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker/timepicker-addon.css') }}">
@endsection

@section('sidebar')
    <!-- Inline datepicker -->
    <section class="event__datepicker">
        <div id="event__datepicker-title">Event date</div>
        <div id="datepicker"></div>
    </section>
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
        // Datepickers - set maxdate, disable Sundays & holidays, pass the date to the calendar
        @include('events.js._datepicker')

        //Empty modal fields after on close
        $(".modal").on("hidden.bs.modal", function() {
            $("input, textarea, select#subject_id, select#classroom_id").val("");
        });

        // Variables
        var calendar = $('#eventCalendar');
        var userName = $('.event__button').attr('data-user'); // $user->name
        var base_url = '../calendar/' + userName; // EventController@index

        calendar.fullCalendar({
            customButtons:{
                @include('events.js._customButton')
            },
            header: {
                left: 'prev,next newEvent',
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
            eventColor: '#ffae00',
            select: function(start, event, jsEvent, view) // Select a date
            {
                @include('events.js._selectDate')
            },
            eventClick: function(event, jsEvent, view) // Click on the event
            {
                @include('events.js._clickEvent')
            },
            eventMouseover: function (event, jsEvent, view)
            {
                @include('events.js._eventMouseOver')
            },
            eventMouseout: function (event, jsEvent, view)
            {
               $(this).css('z-index', 8);
               $('.event__tooltip').remove();
            },
            dayRender: function (date, cell)
            {
                @include('events.js._dayRender')
            }
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

        // Delete the event - remove from the calendar & DB
        @include('events.js._deleteEvent')

    </script>
@endsection
