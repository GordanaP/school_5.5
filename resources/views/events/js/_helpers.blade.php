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
    var tooltip = '<div class="event__tooltip"><b>Subject:</b> ' + event.subject.name + '</br><b>Class:</b> ' + event.classroom.label +  '<br><b>Time:</b> ' + event.start.format(eventTime) + ' - ' + event.end.format(eventTime) + '</div>';

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

// Catholic Easter Sunday
function catholicEasterSunday(year)
{
    var C = Math.floor(year/100);
    var N = year - 19*Math.floor(year/19);
    var K = Math.floor((C - 17)/25);
    var I = C - Math.floor(C/4) - Math.floor((C - K)/3) + 19*N + 15;
    I = I - 30*Math.floor((I/30));
    I = I - Math.floor(I/28)*(1 - Math.floor(I/28)*Math.floor(29/(I + 1))*Math.floor((21 - N)/11));
    var J = year + Math.floor(year/4) + I + 2 - C + Math.floor(C/4);
    J = J - 7*Math.floor(J/7);
    var L = I - J;
    var M = 3 + Math.floor((L + 40)/44);
    var D = L + 28 - 31*Math.floor(M/4);

    return moment(new Date(year, padout(M-1), padout(D)));
}

function padout(number) { return (number < 10) ? '0' + number : number; }


// Orthodox Easter Sunday
function orthodoxEasterSunday(year)
{
    d = (year%19*19+15)%30;

    e = (year%4*2+year%7*4-d+34)%7+d+127;

    month = Math.floor(e/31);

    a = e%31 + 1 + (month > 4);

    return moment(new Date(year, (month-1), a));
}


function isNotHoliday(date)
{
    var year = date.format('YYYY');
    var dateFormatted = date.format(eventDate);
    var january = 0;
    var february = 1;
    var april = 3;
    var may = 4;
    var november = 10;


    var January1 = moment(new Date(year, january, 1)).format(eventDate);
    var January2 = moment(new Date(year, january, 2)).format(eventDate);
    var January7 = moment(new Date(year, january, 7)).format(eventDate);
    var February15 = moment(new Date(year, february, 15)).format(eventDate);
    var February16 = moment(new Date(year, february, 16)).format(eventDate);
    var May1 = moment(new Date(year, may, 1)).format(eventDate);
    var May2 = moment(new Date(year, may, 2)).format(eventDate);
    var Easter = orthodoxEasterSunday(year);
    var GoodFriday = orthodoxEasterSunday(year).subtract(2, 'd').format(eventDate);
    var EasterMonday = orthodoxEasterSunday(year).add(1, 'd').format(eventDate);
    var November11 = moment(new Date(year, november, 11)).format(eventDate);


    var holidays = [January1, January2, January7, February15, February16, May1, May2, Easter, GoodFriday, EasterMonday, November11];

    return holidays.indexOf(dateFormatted) == -1;

}