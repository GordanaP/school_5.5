$(document).on('change', '#subject_id', function() {
    var subject_id = $(this).val(); // the selected option's value
    var user = $('.event__button').data('user'); // the user name
    var url = '../classrooms/' + subject_id + '/' + user; // the rendered classrooms by 'classrooms.index'

    if(subject_id)
    {
        $.ajax({
            url : url,
            type: 'get',
            success: function(response)
            {
                $('#classroom_id').html(response);
            }
        });
    }
});
