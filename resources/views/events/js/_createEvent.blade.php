$(document).on('click', '#storeEvent', function(){

    var title = $('#title').val();
    var description = $('#description').val();
    var subject_id = $('#subject_id').val();
    var classroom = $('#classroom').val();
    var date = $('#date').val();
    var start = $('#start').val();
    var end = $('#end').val();
    var startTime = date + ' ' + start;
    var endTime = date + ' ' + end;

    // Add event to calendar
    var event = {
        title:title,
        description:description,
        start: date,
        end: date,
        allDay: false,
    };

    calendar.fullCalendar( 'renderEvent', event);

    // Store event in the DB
    $.ajax({
        url : base_url,
        type: 'POST',
        data: {
            title : title,
            description : description,
            subject_id : subject_id,
            classroom : classroom,
            start : startTime,
            end : endTime,
        },
        success : function(response) {
            console.log(response.message);
        }
    })
});
