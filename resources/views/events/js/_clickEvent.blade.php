// Open the modal to the auth user only
if(event.teacher_id == Laravel.user.teacher_id)
{
    $('#eventModal').modal('show'); // Open the modal
}

// Handle the modal parameters
$('.modal-title span').text('Edit event'); // Add a title
$('.modal-title i').addClass('fa-pencil-square-o'); // Add a class to the title icon
$('.modal .event__button').text('Save changes').attr('id', 'updateEvent'); // Add text & id to the event button
$('.modal .cancel__button').text('Delete').attr('id', 'deleteEvent'); // Add text & id to the cancel button

// Fetch the event form values from DB
var date = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
var start = $.fullCalendar.moment(event.start).format('HH:mm');
var end = $.fullCalendar.moment(event.end).format('HH:mm');

$('#title').val(event.title);
$('#description').val(event.description);
$('#subject_id').val(event.subject_id);
$('#classroom_id').val(event.classroom_id);
$('#date').val(date);
$('#start').val(start);
$('#end').val(end);

// Assign a data-event attribute containing event id for future reference
$('button#updateEvent').attr('data-event', event.id);