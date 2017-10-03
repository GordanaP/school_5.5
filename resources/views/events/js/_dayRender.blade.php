$('#datepicker').datepicker()
.on("change", function (e) {

    var dateFormatted = date.format('YYYY-MM-DD');
    var datePicker = e.target.value;

    // style the calendar cell
    if (dateFormatted === datePicker) {
        cell.css("background-color", "#daecc6");
    }

    // go to calendar date
    calendar.fullCalendar( 'gotoDate', datePicker );
});