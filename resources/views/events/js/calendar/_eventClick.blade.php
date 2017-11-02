// Open url link in new window
if (event.url) {
    window.open(event.url);
    return false;
}

// Open the custom event modal only & assign the event id for future reference
// For the event id to be assigned to the newly created event, the events must be refetched on the successful ajax post call
isNotHoliday(event.start) ? eventModal.modal('show').attr('data-event', event.id) : '';

// Set the modal parameters
$(".modal-title i").addClass("fa-pencil-square-o");
$(".modal-title span").text("Edit event");
$(".event-button").text("Save changes").attr('id', 'updateEvent');
$(".cancel-button").text("Delete").attr('id', 'deleteEvent');

// Get the classroom options dinamically
var eventId = event.id;
var subjectId = event.subject_id; // the selected option's value
var classroomsEventUrl = '../classrooms/' + subjectId + '/' + userName  + '/' + eventId;; // classrooms rendered by 'classrooms.index'

$.ajax({
    url : classroomsEventUrl,
    type: 'GET',
    success: function(response)
    {
        classroom.html(response);
    }
});

// Populate the modal fields with the event attr values
$("#title").val(event.title);
$("#description").val(event.description);
$("#subject_id").val(event.subject_id);
$("#eventDate").val(event.start.format(eventDate));
$("#start").val(event.start.format(eventTime));
$("#end").val(event.end.format(eventTime));