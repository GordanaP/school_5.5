@extends('layouts.app')

@section('title', ' | My calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">
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
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>
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
            $('#eventForm').formValidation('resetForm', true);
        });

        // Form datepicker - revalidate date field value on selecting the date
        $('#eventDate').datepicker({
            @include('events.js._datepickerOptions'),
            onSelect: function()
            {
                /* Revalidate the field when choosing it from the datepicker */
                $('#eventForm').formValidation('revalidateField', 'eventDate');
            }
        })

        // Inline datepicker - link to the calendar
        $('#datepicker').datepicker({
            @include('events.js._datepickerOptions'),
        })
        .on("change", function (e)
        {
            var datePicker = e.target.value;

            calendar.fullCalendar( 'gotoDate', datePicker );
        })

        // Timepicker
        @include('events.js._timepicker');

        // Variables
        var calendar = $('#eventCalendar');
        var eventDate = "YYYY-MM-DD";
        var eventTime = "HH:mm";
        var TIME_PATTERN = /^(08|1[0-9]{1}):[0-5]{1}[0-9]{1}$/;

        var userName = "{{ $user->name }}";
        var baseUrl = '../calendar/' + userName; // EventController@index
        var holidaysUrl = "{{ route('holidays.index') }}"; // HolidayController@index

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

                        $("#eventDate").val(today.format(eventDate));
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
                    url : baseUrl
                },
                {
                    url : holidaysUrl  // renders events
                },
            ],
            eventColor: '#ffae00',
            // SELECT A DATE
            select: function(start, end, jsEvent, view)
            {
                // Start & end are the moment of the selected field, i.e Tue Oct 03 2017 08:00:00 GMT+0000

                // Open the modal
                isNotSunday(start) && isNotPast(start) && isNotHoliday(start)
                    ? $(".modal").modal('show')
                    : alert('Past dates, Sundays & holidays are not available for creating an event.');

                // Set the modal parameters
                $(".modal-title i").addClass("fa-pencil");
                $(".modal-title span").text("New event");
                $(".cancel-button").text("Cancel");
                $(".event-button").text("Create event").attr('id', 'storeEvent');

                // Set the modal fields' values = the selected calendar date & time values
                $('#eventDate').val(start.format(eventDate));
                minStartHourAndEventDurationOnMonthView(view, start);
            },
            // CLICK ON THE EVENT
            eventClick: function(event, jsEvent, view)
            {
                // Open the modal & assign the event id for future reference
                isNotHoliday(event.start) ? $(".modal").modal('show').attr('data-event', event.id) : '';

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
                $("#eventDate").val(event.start.format(eventDate));
                $("#start").val(event.start.format(eventTime));
                $("#end").val(event.end.format(eventTime));
            },
            // HOVER OVER THE EVENT
            eventMouseover: function (event, jsEvent, view)
            {
                isNotHoliday(event.start) ? hoverOverTheEvent(event) : '';
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
            },
            eventRender: function (event, element)
            {
                var start = moment(event.start);
                var end = moment(event.end);

                //Add class to multiple days event - class attribute in CSS
                while( start.format(eventDate) != end.format(eventDate) ){
                    var dataToFind = start.format(eventDate);
                    $("td[data-date='"+dataToFind+"']").addClass('activeDay');
                    start.add(1, 'd');
                }
            },
        });

        // Populate the classroom select box dinamically depending on the subject
        @include('classrooms.js._subjectClassroomsJs')

        // Validate event form fields values
        $('#eventForm').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled', // modal fields validation
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
                            message: 'The classroom is required'
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
                    verbose: false,
                    validators: {
                        notEmpty: {
                            message: 'The start time is required'
                        },
                        regexp: {
                            regexp: TIME_PATTERN,
                            message: 'The start time must be between 08:00 and 20:00'
                        },
                        callback: {
                            message: 'The start time must be earlier then the end one',
                            callback: function(value, validator, $field) {
                                var endTime = validator.getFieldElements('end').val();
                                if (endTime === '' || !TIME_PATTERN.test(endTime)) {
                                    return true;
                                }

                                var startHour    = parseInt(value.split(':')[0], 10),
                                    startMinutes = parseInt(value.split(':')[1], 10),
                                    endHour      = parseInt(endTime.split(':')[0], 10),
                                    endMinutes   = parseInt(endTime.split(':')[1], 10);

                                if (startHour < endHour || (startHour == endHour && startMinutes < endMinutes)) {
                                    // The end time is also valid
                                    // So, we need to update its status
                                    validator.updateStatus('end', validator.STATUS_VALID, 'callback');
                                    return true;
                                }

                                return false;
                            }
                        }
                    }
                },
                end: {
                    verbose: false,
                    validators: {
                        notEmpty: {
                            message: 'The end time is required'
                        },
                        regexp: {
                            regexp: TIME_PATTERN,
                            message: 'The end time must be between 09:00 and 17:59'
                        },
                        callback: {
                            message: 'The end time must be later then the start one',
                            callback: function(value, validator, $field) {
                                var startTime = validator.getFieldElements('start').val();
                                if (startTime == '' || !TIME_PATTERN.test(startTime)) {
                                    return true;
                                }

                                var startHour    = parseInt(startTime.split(':')[0], 10),
                                    startMinutes = parseInt(startTime.split(':')[1], 10),
                                    endHour      = parseInt(value.split(':')[0], 10),
                                    endMinutes   = parseInt(value.split(':')[1], 10);

                                if (endHour > startHour || (endHour == startHour && endMinutes > startMinutes)) {
                                    // The start time is also valid
                                    // So, we need to update its status
                                    validator.updateStatus('start', validator.STATUS_VALID, 'callback');
                                    return true;
                                }

                                return false;
                            }
                        }
                    }
                },
            }
        })
        .on('success.validator.fv', function(e, data) {
            if (data.field === 'eventDate' && data.validator === 'date' && data.result.date)
            {
                // The eventDate field passes the date validator
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
                        .updateMessage(data.field, data.validator, 'Please choose a day before ' + schoolYearEndFormatted());
                }
            }
        })
        .on('success.form.fv', function(e)
        {
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

            // Create an event - populate the calendar & the DB
            if($(".event-button").attr('id') == 'storeEvent')
            {
                // Create a new event object
                event = {
                    title: title,
                    description: description,
                    subject_id: subjectId,
                    classroom_id: classroomId,
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
                        $('#eventModal').modal('hide');
                        console.log(response.message);
                    }
                });
            }

            // Update an event - in the calendar & the DB
            if($(".event-button").attr('id') == 'updateEvent')
            {
                // EventId & url
                var eventId = $("#eventModal").attr('data-event');
                var eventUrl = baseUrl + '/' + eventId;

                // Get the calendar events (array)
                var event = calendar.fullCalendar('clientEvents', eventId);

                // Set the first event's values
                event[0].id = eventId;
                event[0].title = title;
                event[0].description = description;
                event[0].subject_id = subjectId;
                event[0].classroom_id = classroomId;
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
                        description: description,
                        subject_id: subjectId,
                        classroom_id: classroomId,
                        start: startTime,
                        end: endTime,
                    },
                    success: function(response) {
                        $('#eventModal').modal('hide');
                        console.log(response.message);
                    }
                });
            }
        });

        // Remove the event from the calendar & DB
        @include('events.js._deleteEvent')

    </script>

@endsection