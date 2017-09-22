<script>

    var MAX_READINGS_FIELDS = 3;

    $('#lessonForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            subject_id: {
                validators: {
                    notEmpty: {
                        message: 'The subject is required.'
                    }
                }
            },
            year: {
                validators: {
                    notEmpty: {
                        message: 'The year is required.'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required.'
                    },
                    stringLength: {
                        min: 1,
                        max: 80,
                        message: 'The title must be less than 80 characters long.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The title can only consist of alphabetical, number and space.'
                    }
                }
            },
            topic: {
                validators: {
                    notEmpty: {
                        message: 'The topic is required.'
                    },
                    stringLength: {
                        min: 1,
                        max: 150,
                        message: "The topic must be less than 150 characters long."
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9,.-:;!?(){}\[\] ]+$/,
                        message: 'The topic can only consist of alphabetical, number, punctuation mark, and space.'
                    }
                }
            },
            goals: {
                validators: {
                    notEmpty: {
                        message: 'The goals are required.'
                    },
                    stringLength: {
                        min: 1,
                        max: 300,
                        message: "The goals must be less than 300 characters long."
                    }
                }
            },
            'readings[]': {
                validators: {
                    notEmpty: {
                        message: 'The readings is required.'
                    },
                    stringLength: {
                        min:1,
                        max: 255,
                        message: 'The readings must be less than 255 characters long.'
                    },
                    callback: {
                        callback: function(value, validator, $field) {
                            var $readings    = validator.getFieldElements('readings[]'),
                            numReadings      = $readings.length,
                            notEmptyCount    = 0,
                            obj              = {},
                            duplicateRemoved = [];

                            for (var i = 0; i < numReadings; i++) {
                                var v = $readings.eq(i).val();

                                if (v !== '') {
                                    obj[v] = 0;
                                    notEmptyCount++;
                                }
                            }

                            for (i in obj) {
                                duplicateRemoved.push(obj[i]);
                            }

                            if (duplicateRemoved.length !== notEmptyCount) {
                               return {
                                   valid: false,
                                   message: 'The readings title must be unique'
                               };
                            }

                           validator.updateStatus('readings[]', validator.STATUS_VALID, 'callback');
                           return true;
                       }
                   }
                }
            },
        }
    })
        // Add readings button click handler
        .on('click', '.addReadingsButton', function() {
            var $template = $('#readingsTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $option   = $clone.find('[name="readings[]"]');

            // Add new field
            $('#lessonForm').formValidation('addField', $option);
        })

        // Remove readings button click handler
        .on('click', '.removeReadingsButton', function() {
            var $row    = $(this).parents('.form-group'),
                $option = $row.find('[name="readings[]"]');

            // Remove element containing the readings
            $row.remove();

            // Remove field
            $('#lessonForm').formValidation('removeField', $option);
        })

        // Called after adding new field
        .on('added.field.fv', function(e, data) {
            // data.field   --> The field name
            // data.element --> The new field element
            // data.options --> The new field options

            if (data.field === 'readings[]') {
                if ($('#lessonForm').find(':visible[name="readings[]"]').length >= MAX_READINGS_FIELDS) {
                    $('#lessonForm').find('.addReadingsButton').attr('disabled', 'disabled');
                }
            }
        })

        // Called after removing the field
        .on('removed.field.fv', function(e, data) {
           if (data.field === 'readings[]') {
                if ($('#lessonForm').find(':visible[name="readings[]"]').length < MAX_READINGS_FIELDS) {
                    $('#lessonForm').find('.addReadingsButton').removeAttr('disabled');
                }
            }
        });

</script>