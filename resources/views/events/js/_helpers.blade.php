function isNotSunday(date)
{
    var selectedDate = date.format(eventDate);
    var day = moment(selectedDate).day();

    return day > 0;
}


function isNotPast(date)
{
    var selectedDate = date.format(eventDate);
    var today = moment().format(eventDate);

    return selectedDate >= today;
}

function minStartHourAndEventDurationOnMonthView(view, date, hour=8, minutes=45)
{
    if (view.name == "month")
    {
         // The min start time on month view
        $('#start').val(date.set('hour', hour).format(eventTime))
    }
    else
    {
        $('#start').val(date.format(eventTime));
    }

    $('#end').val(date.add(minutes, 'm').format(eventTime));
}

function hoverOverTheEvent(event)
{
    var tooltip = '<div class="event__tooltip">Time: ' + event.start.format(eventTime) + ' - ' + event.end.format(eventTime) + '</div>';

    $("body").append(tooltip);

    $(this).mouseover(function (e) {
        $(this).css('z-index', 10000);
        $('.event__tooltip').fadeIn('500');
        $('.event__tooltip').fadeTo('10', 1.9);
    })
    .mousemove(function (e)
    {
        $('.event__tooltip').css('top', e.pageY + 10);
        $('.event__tooltip').css('left', e.pageX + 20);
    });
}


function changeCellColor(date, cell, e, bgcolor="#daecc6")
{
    var dateFormatted = date.format(eventDate);
    var datePicker = e.target.value;

    // Go to calendar date
    calendar.fullCalendar( 'gotoDate', datePicker );

    // Add CSS style the calendar cell
    if (dateFormatted === datePicker)
    {
        cell.css("background-color", bgcolor);
    }
    else{
        cell.css("background-color", "#fff");
    }

}