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
}); // Create event