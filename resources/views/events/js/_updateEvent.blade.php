$(document).on('click', 'button#updateEvent', function()
{
    // Variables
    var title = $('#_title').val();
    var description = $('#_description').val();
    var subjectId = $('#_subject_id').val();
    var classroomId = $('#_classroom_id').val();
    var date = $('#_date').val();
    var start = $('#_start').val();
    var end = $('#_end').val();
    var startTime = date + ' ' + start;
    var endTime = date + ' ' + end;

    // Event url
    var eventId = $(this).data('event');
    var eventUrl = baseUrl + '/' + eventId;

    // Create calendar event object
    var event = calendar.fullCalendar('clientEvents', eventId);

    event[0].title = title;
    event[0].description = description;
    event[0].subject_id = subjectId;
    event[0].classroom_id = classroomId;
    event[0].date = date;
    event[0].start = startTime;
    event[0].end = endTime;

    //Update calendar event
    calendar.fullCalendar('updateEvent', event[0]);

    // Update DB event
    $.ajax({
        url: eventUrl,
        type: 'PUT',
        data:{
            title: title,
            description: description,
            subject_id: subjectId,
            classroom_id: classroomId,
            start: startTime,
            end: endTime,
        },
        success: function(response){
            console.log(response.message);
        }
    });
});