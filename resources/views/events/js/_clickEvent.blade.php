// Open the modal to the auth user only
if(event.teacher_id == Laravel.user.teacher_id)
{
    $('#eventModal').modal('show'); // Open the modal
}

// Handle the modal parameters
$('.modal-title span').text('Edit event');
$('.modal-title i').addClass('fa-pencil-square-o');
$('.modal .event__button').text('Save changes')
    .attr('id', 'updateEvent')
    .attr('data-event', event.id); // attach event id for future reference ESSENTAL
$('.modal .cancel__button').text('Delete').attr('id', 'deleteEvent');

// Fetch the event values from DB to the modal input fields
$('#_title').val(event.title);
$('#_description').val(event.description);
$('#_subject_id').val(event.subject_id);
$('#_classroom_id').val(event.classroom_id);
$('#_date').val(event.start.format(eventDate));
$('#_start').val(event.start.format(eventTime));
$('#_end').val(event.end.format(eventTime));