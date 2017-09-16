<script>

    var MAX_OPTIONS = 5;

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
                        message: 'The name is required'
                    }
                }
            },
            year: {
                validators: {
                    notEmpty: {
                        message: 'The year is required'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required'
                    },
                    stringLength: {
                        min: 1,
                        max: 80,
                        message: 'The title must be less than 80 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The title can only consist of alphabetical, number and space'
                    }
                }
            },
            topic: {
                validators: {
                    stringLength: {
                        min: 1,
                        max: 150,
                        message: "The topic must be less than 150 characters long."
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The topic can only consist of alphabetical, number and space'
                    }
                }
            },
            goals: {
                validators: {
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
                        message: 'The readings field cannot be empty'
                    },
                    stringLength: {
                        max: 150,
                        message: 'The readings must be less than 100 characters long'
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

</script>