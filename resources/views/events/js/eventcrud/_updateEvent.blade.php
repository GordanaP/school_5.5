// EventId & url
var eventId = eventModal.attr('data-event'),
    eventUrl = baseUrl + '/' + eventId;

// Update the event object
var clientEv = calendar.fullCalendar('clientEvents', eventId); // array

clientEv[0].title = title;
clientEv[0].description = description;
clientEv[0].subject_id = subjectId;
clientEv[0].classroom_id = classroomId;
clientEv[0].start = startTime;
clientEv[0].end = endTime;


// Update the DB record
$.ajax({
    url: eventUrl,
    type: 'PUT',
    data: event,
    success: function(response) {

        // Update the calendar
        calendar.fullCalendar('updateEvent', clientEv[0]);

        // Hide the modal
        eventModal.modal('hide');
    },
    error: function (response)
    {
        var data = response.responseJSON;
        var errors = data.errors;

        for (let i in errors) {
            showValidationErrors(i, errors[i][0]);
        }

        // Remove error messages
        $("#title, #description, #eventDate, #start, #end").on('keyup', function () {
            clearValidationError($(this).attr('id').replace('#', ''))
        });

        $("#subject_id, #classroom_id").on('change', function () {
            clearValidationError($(this).attr('id').replace('#', ''));
        });
    }
});