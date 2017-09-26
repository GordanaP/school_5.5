$(document).on('change', '#subject_id', function() {
    var subject_id = $(this).val(); // the selected option's value
    var user = $('#storeEvent').data('user'); // the user name
    var url = '../classrooms/' + subject_id + '/' + user; // the rendered classrooms by 'classrooms.index'

    if(subject_id)
    {
        $.ajax({
            url : url,
            type: 'get',
            success: function(response)
            {
                // add the html on classrooms/partials/_teacherClassrooms managed by ClassroomController@index//
                $('#classroom').html(response);
            }
        });
    }
});
