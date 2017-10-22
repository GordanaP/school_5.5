calendar.fullCalendar({
    customButtons:{
        @include('events.js.calendar._customButtons')
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
    //editable: true,
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
    timezone: 'Europe/Belgrade',
    googleCalendarApiKey: 'AIzaSyByHn9BQ2IIrMnMcrklCKeCAXACuV_ABew',
    eventSources: [
        {
            googleCalendarId: 'en.rs#holiday@group.v.calendar.google.com',
        },
        {
            url : baseUrl
        },
    ],
    eventColor: '#ffae00',
    select: function(start, end, jsEvent, view)
    {
        @include('events.js.calendar._selectDate')
    },
    eventClick: function(event, jsEvent, view)
    {
        @include('events.js.calendar._eventClick')
    },
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
        @include('events.js.calendar._dayRender')
    },
    eventRender: function (event, element)
    {
        @include('events.js.calendar._eventRender')
    },
});