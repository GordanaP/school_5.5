// Create a new event object
event = {
    title: title,
    description: description,
    subject_id: subjectId,
    classroom_id: classroomId,
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
        $('#eventModal').modal('hide');

        // Crucial for update the newly created event!
        // Repopulate the calendar with the events to attach the newly created event's id to the #eventModal data-event attribute
        calendar.fullCalendar('refetchEvents');
    }
});