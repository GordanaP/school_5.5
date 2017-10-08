$(document).on('click', '#deleteEvent', function()
{
    // Event url
    var eventId = $('button#updateEvent').data('event');
    var eventUrl = baseUrl + '/' + eventId;

    // Remove the event from the calendar
    calendar.fullCalendar('removeEvents', eventId);

    // Remove the event from the DB
    $.ajax({
        url : eventUrl,
        type: 'DELETE',
        success : function (response) {
            console.log(response.message)
        }
    })
})