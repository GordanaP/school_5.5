$(document).on('change', "#subject_id", function() {
    var subjectId = $(this).val(); // the selected option's value
    var url = '../classrooms/' + subjectId + '/' + userName; // classrooms rendered by 'classrooms.index'

    $.ajax({
        url : url,
        type: 'get',
        success: function(response)
        {
            $("#classroom_id").html(response);
        }
    });

});


$(document).on('change', "#_subject_id", function() {
    var subjectId = $(this).val(); // the selected option's value
    var url = '../classrooms/' + subjectId + '/' + userName; // classrooms rendered by 'classrooms.index'

    $.ajax({
        url : url,
        type: 'get',
        success: function(response)
        {
            $("#_classroom_id").html(response);
        }
    });

});
