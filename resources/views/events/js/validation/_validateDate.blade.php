// The eventDate field passes the date validator
var currentDate = moment(data.result.date, eventDate, true);

// The selected date is Sunday
if (! isNotSunday(currentDate)) {
    // Treat the field as invalid
    data.fv
        .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
        .updateMessage(data.field, data.validator, 'Please choose a day except Sunday');
}

// The selected date is holiday
if (! isNotHoliday(currentDate)) {
    // Treat the field as invalid
    data.fv
        .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
        .updateMessage(data.field, data.validator, 'Please choose a day except national holiday');
}

// The selected date is in the past
if (currentDate.isBefore(today()))
{
    data.fv
    .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
    .updateMessage(data.field, data.validator, 'Please choose a day after today');
}

// The selected date is after the max date
if (currentDate.isAfter(schoolYearEnd()))
{
    data.fv
        .updateStatus(data.field, data.fv.STATUS_INVALID, data.validator)
        .updateMessage(data.field, data.validator, 'Please choose a day before ' + schoolYearEndFormatted());
}