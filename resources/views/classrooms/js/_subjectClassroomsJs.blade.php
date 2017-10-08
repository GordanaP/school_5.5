$(document).on('change', "#subject_id", function() {
    var subjectId = $(this).val(); // the selected option's value
    var classroomsUrl = '../classrooms/' + subjectId + '/' + userName; // classrooms rendered by 'classrooms.index'

    $.ajax({
        url : classroomsUrl,
        type: 'GET',
        success: function(response)
        {
            $("#classroom_id").html(response);
        }
    });

});