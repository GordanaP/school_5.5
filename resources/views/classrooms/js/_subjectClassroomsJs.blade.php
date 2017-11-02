subject.on('change', function(e) {
    var subjectId = e.target.value; // the selected option's value
    var classroomsUrl = '../classrooms/' + subjectId + '/' + userName; // classrooms rendered by 'classrooms.index'

    $.ajax({
        url : classroomsUrl,
        type: 'GET',
        success: function(response)
        {
            classroom.html(response);
        }
    });
});