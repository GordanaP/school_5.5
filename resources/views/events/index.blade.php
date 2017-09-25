@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">

    <style>
        main.calendar {background: #fff; padding: 18px}
        div.modal-content {border-radius: 0}

        #eventModal{ font-size: 13px }
        #eventModal .modal-header{
            border-bottom: 0;
            background-color: #f5f5f6;
            border-top: 6px solid #ffc64d;
        }
        #eventModal .modal-footer{
            border-top: 0;
            background: #f5f5f6;
            border-bottom: 1px solid  #ffc64d;
        }
        #eventModal .event__button { background: #9CCC65; border: 1px solid #9ccc65}
        #eventModal .event__button:hover { background: #6B9B37;}
        #eventModal .cancel__button { background: #cc8b00; border: 1px solid  #cc8b00; color: #fff;}
        #eventModal .close__button { border: 1px solid  cc8b00;}
    </style>
@endsection


@section('content')

    <!-- Calendar -->
    <main class="calendar">
        <div id="eventCalendar"></div>
    </main>

    @include('events.partials._eventModal')

@endsection

@section('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>

    <script>

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
        select: function(start, event, jsEvent, view){ // Select a fullcalendar date

            // Handle event modal
            if( Laravel.user.role.teacher || Laravel.user.role.admin || Laravel.user.role.superadmin)
            {
                $('#eventModal').modal('show'); // Open the modal
                $('.modal-title span').text('New event'); // Add title
                $('.modal-title i').addClass('fa-pencil'); // Add class to the title icon
                $('.modal .event__button').text('Create event'); // Add text to the button
                $('.modal .event__button').attr('id', 'storeEvent'); // Add id to the button
            }
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

    </script>
@endsection
