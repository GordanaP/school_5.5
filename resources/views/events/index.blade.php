@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.5.1/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.5.1/fullcalendar.print.min.css') }}" type="media" >
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.css') }}">
@endsection

@section('sidebar')
{{--     <section class="event__datepicker">
        <div id="event__datepicker-title">Event date</div>
        <div id="datepicker"></div>
    </section> --}}
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

        // Empty the modal fields on close
        $(".modal").on("hidden.bs.modal", function() {
            $("input, select, data-event").val("").end();
        });

        // Variables
        var calendar = $('#eventCalendar');
        var userName = "{{ $user->name }}";
        var baseUrl = '../calendar/' + userName; // EventController@index

        // Initialize fullcalendar with options
        calendar.fullCalendar({
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
                }
            ],
            eventColor: '#ffae00',
            // SELECT A DATE
            select: function(start, end, jsEvent, view)
            {
                // Start & end are the moment of the selected field, i.e Tue Oct 03 2017 08:00:00 GMT+0000

                // Open the modal
                $(".modal").modal('show');

                // Set the modal parameters
                $(".modal-title i").addClass("fa-pencil");
                $(".modal-title span").text("New event");
                $(".cancel-button").text("Cancel");
                $(".event-button").text("Create event").attr('id', 'storeEvent');

                // Set the modal fields' values = the selected calendar date & time values
                $('#date').val(start.format('YYYY-MM-DD'));

                if (view.name == "month")
                {
                     // The min start time on month view
                    $('#start').val(start.set('hour', 8).format('HH:mm'))
                }
                else
                {
                    $('#start').val(start.format('HH:mm'));
                }

                // Set the end to happen 45 min after the start
                $('#end').val(start.add(45, 'm').format('HH:mm'));
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
                $("#date").val(event.start.format('YYYY-MM-DD'));
                $("#start").val(event.start.format('HH:mm'));
                $("#end").val(event.end.format('HH:mm'));
            },
        }); // FullCalendar


        // CREATE A NEW EVENT
        $(document).on('click', '#storeEvent', function()
        {
            // The modal fields' values
            var title = $('#title').val();
            var date = $('#date').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var startTime = date + ' ' + start;
            var endTime = date + ' ' + end;

            // Create a new event object
            event = {
                title: title,
                start: startTime,
                end: endTime,
            }

            // Display the event in the calendar
            calendar.fullCalendar('renderEvent', event);

            // Store the event in DB
            $.ajax({
                url: baseUrl,
                type: 'POST',
                data: event,
                success: function(response){
                    console.log(response.message);

                    // Repopulate the calendar with the events to attach the newly created event's id to the #eventModal data-event attribute
                    calendar.fullCalendar('refetchEvents')
                }
            });

        })

        // UPDATE AN EVENT
        $(document).on('click', '#updateEvent', function()
        {
            // The modal fields' values
            var title = $('#title').val();
            var date = $('#date').val();
            var start = $('#start').val();
            var end = $('#end').val();
            var startTime = date + ' ' + start;
            var endTime = date + ' ' + end;

            // EventId & url
            var eventId = $("#eventModal").attr('data-event');
            var eventUrl = baseUrl + '/' + eventId;

            // Get the calendar events (array)
            var event = calendar.fullCalendar('clientEvents', eventId);

            // Set the first event's values
            event[0].id = eventId;
            event[0].title = title;
            event[0].start = startTime;
            event[0].end = endTime;

            // Update the calendar event
            calendar.fullCalendar('updateEvent', event[0]);

            // Update the DB record
            $.ajax({
                url: eventUrl,
                type: 'PUT',
                data: {
                    id: eventId,
                    title: title,
                    start: startTime,
                    end: endTime,
                },
                success: function(response) {
                    console.log(response.message);
                }
            })
        })

        // DELETE AN EVENT
        $(document).on('click', '#deleteEvent', function()
        {
            // EventId and url
            var eventId = $("#eventModal").attr('data-event');
            var eventUrl = baseUrl + '/' + eventId;

            // Remove the event from the calendar
            calendar.fullCalendar('removeEvents', eventId);

            // Remove the event from DB
            $.ajax({
                url: eventUrl,
                type: 'DELETE',
                success: function(response) {
                    console.log(response.message);
                }
            })
        });

    </script>

@endsection
