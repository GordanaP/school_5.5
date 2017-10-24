// Store the event in DB
$.ajax({
    url: baseUrl,
    type: 'POST',
    data: event,
    success: function(response)
    {
        // Display the event in the calendar
        calendar.fullCalendar('renderEvent', event);

        // Hide the modal
        eventModal.modal('hide');

        // Crucial for update the newly created event without refreshing the page!
        // Repopulate the calendar with the events to attach the newly created event's id to the #eventModal data-event
        calendar.fullCalendar('refetchEvents');
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