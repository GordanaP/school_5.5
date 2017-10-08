$('#datepicker').datepicker()
    .on("change", function (e) {

        var dateFormatted = date.format(eventDate);
        var datePicker = e.target.value;

        // style the calendar cell
        if (dateFormatted === datePicker) {
            cell.css("background-color", "#daecc6");
        }
        else{
            cell.css("background-color", "#fff");
        }

        // go to calendar date
        calendar.fullCalendar( 'gotoDate', datePicker );
    });