dateFormat: "yy-mm-dd", // 2017-09-27
minDate: 0, // today
changeMonth: true,
changeYear: true,
firstDay: 1, // Monday,
beforeShowDay: function(date) // disable and mark in red Sundays & holidays
{
    var day = date.getDay();
    var year = date.getFullYear();
    var formattedDate = jQuery.datepicker.formatDate('yy-mm-dd', date);

    var January1 = year + "-01-01";
    var January2 = year + "-01-02";
    var January7 = year + "-01-07";
    var February15 = year + "-02-15";
    var February16 = year + "-02-16";
    var May1 = year + "-05-01";
    var May2 = year + "-05-02";
    var November11 = year + "-11-11";
    var GoodFriday = orthodoxEasterSunday(year).subtract(2, 'd').format(eventDate);
    var EasterMonday = orthodoxEasterSunday(year).add(1, 'd').format(eventDate);

    var holidays = [January1, January2, January7, February15, February16, May1, May2, November11, GoodFriday, EasterMonday];

    // Sundays
    if (day == 0)
    {
        // false = nonselectable field, markholiday = css class
        return [false, "markholiday"];
    }
    else
    {
        // returns -1 if the value is not in the array, otherways returns the value of the index
        return (holidays.indexOf(formattedDate) == -1) ? [true] : [false, "markholiday"];
    }
}