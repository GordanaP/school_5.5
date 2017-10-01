$(document).on('click', '#deleteEvent', function(){

    // Variables
    var eventId = $('#updateEvent').data('event');
    var url = base_url + '/' + eventId;

    // Remove the event from the calendar
    calendar.fullCalendar('removeEvents', eventId);

    // Remove the event from the DB
    $.ajax({
        type: 'DELETE',
        url : url,
        success : function (response) {
            console.log(response.message)
        }
    })
})