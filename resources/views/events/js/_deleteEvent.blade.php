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
    });
}); // Delete event