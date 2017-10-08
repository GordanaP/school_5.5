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
    });
}); // Update event
