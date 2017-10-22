// EventId & url
var eventId = $("#eventModal").attr('data-event'),
    eventUrl = baseUrl + '/' + eventId;

// Get the calendar events (array)
var event = calendar.fullCalendar('clientEvents', eventId);

// Set the first event's values
event[0].id = eventId;
event[0].title = title;
event[0].description = description;
event[0].subject_id = subjectId;
event[0].classroom_id = classroomId;
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
        description: description,
        subject_id: subjectId,
        classroom_id: classroomId,
        start: startTime,
        end: endTime,
    },
    success: function(response) {
        console.log(response.message);
        $('#eventModal').modal('hide');
    }
});