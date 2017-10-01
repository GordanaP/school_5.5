$(document).on('click', 'button#updateEvent', function(){

    // Variables
    var title = $('#title').val();
    var description = $('#description').val();
    var subjectId = $('#subject_id').val();
    var classroomId = $('#classroom_id').val();
    var date = $('#date').val();
    var start = $('#start').val();
    var end = $('#end').val();
    var startTime = date + ' ' + start;
    var endTime = date + ' ' + end;

    var eventId = $(this).data('event');
    var url = base_url + '/' + eventId;

    // Create fullcalendar event object
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
        type: 'put',
        url: url,
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