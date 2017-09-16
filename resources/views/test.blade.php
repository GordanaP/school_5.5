@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/formvalidation/dist/css/formValidation.min.css') }}">

    <style>
       form#lessonForm i.glyphicon-remove, i.glyphicon-ok{margin-right: 12px;}
    </style>
@endsection

@section('content')

    <div class="row">
        <aside class="col-md-3">
            <ul>
                <li><a href="#">My portfolio</a></li>
            </ul>
        </aside>

        <main class="col-md-9 lecture">

            @include('errors._list')
            @include('flash::message')

            <div class="wrapper">

                <div class="btn btn-primary" id="addReadingsField">Add field</div>

                <form action="#" id="lessonForm" method="post">

                    <div class="form-group" id="initialReadingsField">
                        <label>Readings</label>
                        <div class="row">
                            <div class="col-md-11">
                                <input type="text" class="form-control" name="readings[]" />
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-default addReadings">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- The readings field template containing an readings field and a Remove button -->
                    <div class="form-group hide" id="readingsTemplate">
                        <div class="row">
                            <div class="col-md-11">
                                <input class="form-control" type="text" name="readings[]" />
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-default removeReadings">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Validate</button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </main>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/formvalidation/dist/js/formValidation.min.js') }}"></script>
    <script src="{{ asset('vendor/formvalidation/dist/js/framework/bootstrap.min.js') }}"></script>

    <script>

        // The maximum number of options
        var MAX_OPTIONS = 5;

        // $('#initialReadingsField').hide();

        // $('#addReadingsField').on('click', function(){
        //     $('#initialReadingsField').show();
        // })

        $('#lessonForm')
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
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
                    }
                }
            })

            // Add button click handler
            .on('click', '.addReadings', function() {
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

            // Remove button click handler
            .on('click', '.removeReadings', function() {
                var $row    = $(this).parents('.form-group'),
                    $option = $row.find('[name="readings[]"]');

                // Remove element containing the option
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
                    if ($('#lessonForm').find(':visible[name="readings[]"]').length >= MAX_OPTIONS) {
                        $('#lessonForm').find('.addReadings').attr('disabled', 'disabled');
                    }
                }
            })

            // Called after removing the field
            .on('removed.field.fv', function(e, data) {
               if (data.field === 'readings[]') {
                    if ($('#lessonForm').find(':visible[name="readings[]"]').length < MAX_OPTIONS) {
                        $('#lessonForm').find('.addReadings').removeAttr('disabled');
                    }
                }
            });
    </script>

@endsection