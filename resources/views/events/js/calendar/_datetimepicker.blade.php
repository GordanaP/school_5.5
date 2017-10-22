// Form datepicker - revalidate date field value on selecting the date
$('#eventDate').datepicker({
    @include('events.js.calendar._datepickerOptions'),
    onSelect: function()
    {
        $('#eventForm').formValidation('revalidateField', 'eventDate');
    }
})

// Inline datepicker - link to the calendar
$('#datepicker').datepicker({
    @include('events.js.calendar._datepickerOptions'),
})
.on("change", function (e)
{
    var datePicker = e.target.value;

    calendar.fullCalendar( 'gotoDate', datePicker );
})

var startTime = $("#start");
var endTime = $("#end");

$.timepicker.timeRange(
    startTime,
    endTime,
    {
        controlType: 'select', // dropdown menu instead of slider
        oneLine: true,
        timeFormat: eventTime,
        //minInterval: (1000*60*45), // 45 min
        hourMin: 8,
        hourMax: 20,
        // start: {}, // start picker options
        // end: {}, // end picker options
        onSelect: function() {
            $('#eventForm').formValidation('revalidateField', 'start');
            $('#eventForm').formValidation('revalidateField', 'end');
        },
    },
);
