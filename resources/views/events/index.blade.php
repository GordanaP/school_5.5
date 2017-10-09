@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.5.1/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.5.1/fullcalendar.print.min.css') }}" type="media" >
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.css') }}">
@endsection

@section('sidebar')
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
    <script src="{{ asset('vendor/moment-2.18.1/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar-3.5.1/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.js') }}"></script>

    <script>

        // Helper js function
        @include('events.js._helpers')


        // Empty the modal fields on close
        $(".modal").on("hidden.bs.modal", function() {
            $("input, select#subject_id, select#classroom_id, data-event").val("").end();
        });

        // Datepicker - set min & max date, disable Sundays & holidays
        @include('events.js._datepicker')

        // Timepicker - set time format, min & max time, min time interval
        @include('events.js._timepicker')


        // Variables
        var calendar = $('#eventCalendar');
        var eventDate = "YYYY-MM-DD";
        var eventTime = "HH:mm";

        var userName = "{{ $user->name }}";
        var baseUrl = '../calendar/' + userName; // EventController@index

        // Initialize fullcalendar with options
        calendar.fullCalendar({
            customButtons:{
                newEvent: {
                    text: 'New event',
                    click: function(event, jsEvent, view)
                    {
                        var today = moment();

                        // Open the modal
                        $('#eventModal').modal('show');

                        // Set the modal parameters
                        $(".modal-title i").addClass("fa-pencil");
                        $(".modal-title span").text("New event");
                        $(".cancel-button").text("Cancel");
                        $(".event-button").text("Create event").attr('id', 'storeEvent');

                        $("#date").val(today.format(eventDate));
                        $("#start").val('8:00');
                        $("#end").val('8:45');
                    },
                },
            },
            header: {
                left: 'prev,next newEvent',
                center: 'title',
                right: 'month, agendaWeek, agendaDay, list'
            },
            defaultView: 'month',
            handleWindowResize: true,
            displayEventTime: false,
            showNonCurrentDates: true,
            slotDuration: '00:15:00',
            firstDay: 1,
            navLinks: true,
            selectable: true,
            editable: true,
            selectHelper: true,
            businessHours: [
                {
                    dow: [ 1, 2, 3, 4, 5, 6 ],
                    start: '08:00:00',
                    end: '20:00:00'
                }
            ],
            minTime: "08:00:00",
            maxTime: "20:00:00",
            eventLimit: true,
            eventSources: [
                {
                    url : baseUrl  // renders events
                },
            ],
            eventColor: '#ffae00',
            // SELECT A DATE
            select: function(start, end, jsEvent, view)
            {
                // Start & end are the moment of the selected field, i.e Tue Oct 03 2017 08:00:00 GMT+0000

                // Open the modal
                isNotSunday(start) && isNotPast(start)
                    ? $(".modal").modal('show')
                    : alert('Past dates and Sundays are not available for creating an event.');

                // Set the modal parameters
                $(".modal-title i").addClass("fa-pencil");
                $(".modal-title span").text("New event");
                $(".cancel-button").text("Cancel");
                $(".event-button").text("Create event").attr('id', 'storeEvent');

                // Set the modal fields' values = the selected calendar date & time values
                $('#date').val(start.format(eventDate));
                minStartHourAndEventDurationOnMonthView(view, start);

            },
            // CLICK ON THE EVENT
            eventClick: function(event, jsEvent, view)
            {
                // Open the modal & assign the event id for future reference
                $(".modal").modal('show').attr('data-event', event.id);

                // Set the modal parameters
                $(".modal-title i").addClass("fa-pencil-square-o");
                $(".modal-title span").text("Edit event");
                $(".event-button").text("Save changes").attr('id', 'updateEvent');
                $(".cancel-button").text("Delete").attr('id', 'deleteEvent');

                // Populate the modal fields with the event attr values
                $("#title").val(event.title);
                $("#description").val(event.description);
                $("#subject_id").val(event.subject_id);
                $("#classroom_id").val(event.classroom_id);
                $("#date").val(event.start.format(eventDate));
                $("#start").val(event.start.format(eventTime));
                $("#end").val(event.end.format(eventTime));
            },
            // HOVER OVER THE EVENT
            eventMouseover: function (event, jsEvent, view)
            {
                hoverOverTheEvent(event);
            },
            eventMouseout: function (event, jsEvent, view)
            {
               $(this).css('z-index', 8);
               $('.event__tooltip').remove();
            },
            dayRender: function (date, cell)
            {
                $('#datepicker').datepicker()
                    .on("change", function (e)
                    {
                        changeCellColor(date, cell, e)
                    });
            }
        });

        // Populate the classroom select box dinamically depending on the subject
        @include('classrooms.js._subjectClassroomsJs')

        // Create an event - populate the calendar & the DB
        @include('events.js._storeEvent')

        // Update the event in the calendar RT& DB
        @include('events.js._updateEvent')

        // Remove the event from the calendar & DB
        @include('events.js._deleteEvent')



    </script>

@endsection
