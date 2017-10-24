// Start & end are the moment of the selected field, i.e Tue Oct 03 2017 08:00:00 GMT+0000

// Open the modal
isNotSunday(start) && isNotPast(start) && isNotHoliday(start)
    ? eventModal.modal('show')
    : alert('Past dates, Sundays & holidays are not available for creating an event.');

// Set the modal parameters
$(".modal-title i").addClass("fa-pencil");
$(".modal-title span").text("New event");
$(".cancel-button").text("Cancel");
$(".event-button").text("Create event").attr('id', 'storeEvent');

// Set the modal fields' values = the selected calendar date & time values
$('#eventDate').val(start.format(eventDate));
minStartHourAndEventDurationOnMonthView(view, start);