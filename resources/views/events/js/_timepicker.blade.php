var startTime = $('#start');
var endTime = $('#end');

$.timepicker.timeRange(
    startTime,
    endTime,
    {
        controlType: 'select', // dropdown menu instead of slider
        oneLine: true,
        timeFormat: 'HH:mm',
        minInterval: (1000*60*45), // 45 min
        hourMin: 7,
        hourMax: 19,
        start: {}, // start picker options
        end: {} // end picker options
    }
);