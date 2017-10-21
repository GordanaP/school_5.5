$("#datepicker").datepicker({
    @include('events.js._datepickerOptions'),
});

// Set max date in datepicker
var today = new Date();
var currYear = today.getFullYear();
var nextYear = currYear + 1;
var currMonth = today.getMonth();

var year = currMonth >=8 && currMonth <=11 ? nextYear : currYear
var month = 7;
var day = 31.

var maxDate = new Date(year, month, day);

$("input[name='date'], #datepicker").datepicker( "option", "maxDate", maxDate);