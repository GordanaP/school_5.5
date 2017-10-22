var endTime = validator.getFieldElements('end').val();

if (endTime === '' || !TIME_PATTERN.test(endTime)) {
    return true;
}

var startHour    = parseInt(value.split(':')[0], 10),
    startMinutes = parseInt(value.split(':')[1], 10),
    endHour      = parseInt(endTime.split(':')[0], 10),
    endMinutes   = parseInt(endTime.split(':')[1], 10);

if (startHour < endHour || (startHour == endHour && startMinutes < endMinutes)) {
    // The end time is also valid
    // So, we need to update its status
    validator.updateStatus('end', validator.STATUS_VALID, 'callback');
    return true;
}

return false;