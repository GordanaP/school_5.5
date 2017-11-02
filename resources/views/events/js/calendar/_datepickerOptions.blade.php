dateFormat: "yy-mm-dd", // 2017-09-27
minDate: 0, // today
maxDate: datepickerMaxDate(),
changeMonth: true,
changeYear: true,
firstDay: 1, // Monday,
beforeShowDay: function(date) // disable and mark in red Sundays & holidays
{
    var day = date.getDay(),
        year = date.getFullYear(),
        formattedDate = jQuery.datepicker.formatDate('yy-mm-dd', date),

        January1 = year + "-01-01",
        January2 = year + "-01-02",
        January7 = year + "-01-07",
        February15 = year + "-02-15",
        February16 = year + "-02-16",
        May1 = year + "-05-01",
        May2 = year + "-05-02",
        November11 = year + "-11-11",
        GoodFriday = orthodoxEasterSunday(year).subtract(2, 'd').format(eventDate),
        EasterMonday = orthodoxEasterSunday(year).add(1, 'd').format(eventDate);

        var holidays = [January1, January2, January7, February15, February16, May1, May2, November11, GoodFriday, EasterMonday];

    // Sundays
    if (day == 0)
    {
        // false = nonselectable field, markholiday = css class
        return [false, "markholiday"];
    }
    // Holidays
    else
    {
        // returns -1 if the value is not in the array, otherways returns the value of the index
        return (holidays.indexOf(formattedDate) == -1) ? [true] : [false, "markholiday"];
    }
}