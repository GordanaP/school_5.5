// EventId & url
var eventId = eventModal.attr('data-event'),
    eventUrl = baseUrl + '/' + eventId;

// Update the calendar event
var clientEv = calendar.fullCalendar('clientEvents', eventId); // array

clientEv[0].title = title;
clientEv[0].description = description;
clientEv[0].subject_id = subjectId;
clientEv[0].classroom_id = classroomId;
clientEv[0].start = startTime;
clientEv[0].end = endTime;

calendar.fullCalendar('updateEvent', clientEv[0]);

// Update the DB record
$.ajax({
    url: eventUrl,
    type: 'PUT',
    data: event,
    success: function(response) {
        console.log(response.message);
        eventModal.modal('hide');
    }
});