@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <style>
        .markholiday .ui-state-default
        {
            color: red;
        }
    </style>
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

    <script>

        // Empty modal fields content after closing it
        $(".modal").on("hidden.bs.modal", function() {
            $("input, select").val("").end();
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
            // On selecting a date - display modal to create a new event
            select: function(start, event, jsEvent, view){

                // Open the event modal
                if( Laravel.user.role.teacher || Laravel.user.role.admin || Laravel.user.role.superadmin)
                {
                    $('#eventModal').modal('show'); // Open the modal
                }

                //Set the modal parameters
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

        // Datepicker
        $("#date").datepicker({
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

                var holidays = [January1, January2, January7, February15, February16, May1, May2, November11];

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
            }
        });

        // Set max date in datepicker
        var today = new Date();
        var currYear = today.getFullYear();
        var nextYear = currYear + 1;
        var currMonth = today.getMonth();

        var year = currMonth >=8 && currMonth <=11 ? nextYear : currYear
        var month = 7;
        var day = 31.

        var maxDate = new Date(year, month, day);

        $("#date").datepicker( "option", "maxDate", maxDate);

    </script>
@endsection
