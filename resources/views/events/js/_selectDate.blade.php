// Open the modal only from today on and by authorized users
var selectedDate = start.format(eventDate);
var today = moment().format(eventDate);
var day = moment(selectedDate).day();

if(selectedDate >= today && day > 0)
{
    if( Laravel.user.role.teacher || Laravel.user.role.admin || Laravel.user.role.superadmin)
    {
        $('#eventModal').modal('show');
    }
}
else
{
    alert('Past dates and Sundays are not available for creating an event.');
}

// Set the modal parameters
$('.modal-title span').text('New event');
$('.modal-title i').addClass('fa-pencil');
$('.modal .event__button').text('Create event').attr('id', 'storeEvent');
$('.modal .cancel__button').text('Cancel');

// Set the date & times input fields values: start = moment(selectedDate);
$('#date').val(start.format(eventDate));
$('#start').val(start.format(eventTime));
$('#end').val(start.format(eventTime));
