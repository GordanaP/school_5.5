eventForm.formValidation({
    framework: 'bootstrap',
    excluded: ':disabled', // modal fields validation
    icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        title: {
            validators: {
                notEmpty: {
                    message: 'The title is required'
                },
                stringLength: {
                    max: 70,
                    message: 'The title must be less than 70 characters long'
                }
            }
        },
        description: {
            validators: {
                stringLength: {
                    min:5,
                    max: 150,
                    message: 'The description must be between 5 and 150 characters long'
                }
            }
        },
        subject_id: {
            validators: {
                notEmpty: {
                    message: 'The subject is required'
                },
            }
        },
        classroom_id: {
            validators: {
                notEmpty: {
                    message: 'The classroom is required'
                },
            }
        },
        eventDate: {
            validators: {
                notEmpty: {
                    message: 'The date is required'
                },
                date: {
                    format: eventDate,
                    message: 'The date format is not valid'
                }
            }
        },
        start: {
            verbose: false,
            validators: {
                notEmpty: {
                    message: 'The start time is required'
                },
                regexp: {
                    regexp: TIME_PATTERN,
                    message: 'The start time must be between 08:00 and 20:00'
                },
                callback: {
                    message: 'The start time must be earlier then the end one',
                    callback: function(value, validator, $field) {

                        @include('events.js.validation._validateStart')
                    }
                }
            }
        },
        end: {
            verbose: false,
            validators: {
                notEmpty: {
                    message: 'The end time is required'
                },
                regexp: {
                    regexp: TIME_PATTERN,
                    message: 'The end time must be between 09:00 and 17:59'
                },
                callback: {
                    message: 'The end time must be later then the start one',
                    callback: function(value, validator, $field) {
                        @include('events.js.validation._validateEnd')
                    }
                }
            }
        },
    }
})
.on('success.validator.fv', function(e, data) {
    if (data.field === 'eventDate' && data.validator === 'date' && data.result.date)
    {
        @include('events.js.validation._validateDate')
    }
})
.on('success.form.fv', function(e)
{
    // Prevent page refreshing
    e.preventDefault();

    // Get the event attributes' values
    var title = $('#title').val(),
        description = $('#description').val(),
        subjectId = $('#subject_id').val(),
        classroomId = $('#classroom_id').val(),
        date = $('#eventDate').val(),
        start = $('#start').val(),
        end = $('#end').val(),
        startTime = date + ' ' + start,
        endTime = date + ' ' + end;

    // Create an event object
    event = {
        title: title,
        description: description,
        subject_id: subjectId,
        classroom_id: classroomId,
        start: startTime,
        end: endTime,
    }

    // Populate the calendar & the DB with a new event
    if($(".event-button").attr('id') == 'storeEvent')
    {
        @include('events.js.eventcrud._storeEvent')
    }

    // Update an event - in the calendar & the DB
    if($(".event-button").attr('id') == 'updateEvent')
    {
        @include('events.js.eventcrud._updateEvent')
    }
});