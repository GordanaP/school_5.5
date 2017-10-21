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
            /* Revalidate the field when choosing it from the datepicker */
            $('#eventForm').formValidation('revalidateField', 'start');
            $('#eventForm').formValidation('revalidateField', 'end');
        },
    },
);
