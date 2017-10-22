var startTime = validator.getFieldElements('start').val();
if (startTime == '' || !TIME_PATTERN.test(startTime)) {
    return true;
}

var startHour    = parseInt(startTime.split(':')[0], 10),
    startMinutes = parseInt(startTime.split(':')[1], 10),
    endHour      = parseInt(value.split(':')[0], 10),
    endMinutes   = parseInt(value.split(':')[1], 10);

if (endHour > startHour || (endHour == startHour && endMinutes > startMinutes)) {
    // The start time is also valid
    // So, we need to update its status
    validator.updateStatus('start', validator.STATUS_VALID, 'callback');
    return true;
}

return false;