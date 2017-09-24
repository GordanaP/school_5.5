@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">

    <style>
        main.calendar {background: #fff; padding: 18px}
    </style>
@endsection


@section('content')


    <!-- Calendar -->
    <main class="calendar">
        <div id="eventCalendar"></div>
    </main>

@endsection

@section('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>

    <script>

    var calendar = $('#eventCalendar');
    var user = window.Laravel.user;
    var base_url = '../calendar/' + user;

    calendar.fullCalendar({
        header: {
            left: 'prev,next tkoday newEvent',
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
                url : base_url
            }
        ]
    });

    </script>
@endsection
