// Open the event modal only from today on and by authorized users
var selectedDate = start.format("YYYY-MM-DD");
var today = moment().format("YYYY-MM-DD");

if(selectedDate >= today)
{
    if( Laravel.user.role.teacher || Laravel.user.role.admin || Laravel.user.role.superadmin)
    {
        $('#eventModal').modal('show');
    }
}
else
{
    alert('You can not create an event in the past.');
}

// Set the modal parameters
$('.modal-title span').text('New event'); // Add title
$('.modal-title i').addClass('fa-pencil'); // Add class to the title icon
$('.modal .event__button').text('Create event').attr('id', 'storeEvent'); // Add text & attr to the event button
$('.modal .cancel__button').text('Cancel'); // Add text to the cancel button

// Set the date & times input fields value by using momentjs
start = moment(start.format());
$('#date').val(start.format('YYYY-MM-DD'));
$('#start').val(start.format('08:00'));
$('#end').val(start.format('08:45'));