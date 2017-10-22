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

        var calendar = $('#eventCalendar'),
            eventDate = "YYYY-MM-DD",
            eventTime = "HH:mm",
            TIME_PATTERN = /^(08|1[0-9]{1}):[0-5]{1}[0-9]{1}$/,

            userName = "{{ $user->name }}",
            baseUrl = '../calendar/' + userName, // EventController@index
            holidaysUrl = "{{ route('holidays.index') }}"; // HolidayController@index

        // Empty the modal fields on close
        $(".modal").on("hidden.bs.modal", function() {
            $("input, select#subject_id, select#classroom_id, data-event").val("").end();
            $('#eventForm').formValidation('resetForm', true);
        });

        // Helper js function
        @include('events.js._helpers')

        // Datepicker
        @include('events.js.calendar._datetimepicker');

        // Populate the classroom select box dinamically depending on the subject
        @include('classrooms.js._subjectClassroomsJs')

        // Initialize fullcalendar with options
        @include('events.js.calendar._fullcalendar')

        // Validate event form fields values
        @include('events.js.validation._validateForm')

        // Remove the event from the calendar & DB
        @include('events.js.eventcrud._deleteEvent')

    </script>
@endsection