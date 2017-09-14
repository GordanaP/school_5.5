<section class="lecture__title">
    <div class="row">

        <!-- Subject -->
        <div class="col-md-8">
            <div class="form-group" id="subject">
                <label for="subject_id">Subject <span class="asterisk">*</span></label>
                <select class="form-control" name="subject_id" id="subject_id">
                    <option selected="" disabled="">Select a subject</option>
                    @foreach ($user->teacher->subjects->unique() as $subject)
                        <option value="{{ $subject->id }}"
                            {{ selected($subject->id, $subject_id) }}
                        >
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Year -->
        <div class="col-md-4">
            <div class="form-group" id="year">
                <label for="year">Academic year <span class="asterisk">*</span></label>
                <select class="form-control" name="year" id="year">
                    <option selected="" disabled="">Select a year</option>
                    @foreach (Year::all() as $label => $name)
                        <option value="{{ $label }}"
                            {{ selected($label, $year) }}
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

<section class="lecture__info" id="general">
    <div class="panel">
        <div class="panel-heading text-uppercase ls-1">
            General
        </div>
        <div class="panel-body">
            <p class="required__fields">Fields marked with * are required.</p>

            <!-- Title -->
            <div class="form-group">
                <label for="title">Title <span class="asterisk">*</span></label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $title }}" placeholder="Lesson title">
            </div>

            <!-- Topic -->
            <div class="form-group">
                <label for="topic">Topic</label>
                <input type="text" class="form-control" name="topic" id="topic" value="{{ $topic }}" placeholder="Lesson topic">
            </div>

            <!-- Goals -->
            <div class="form-group">
                <label for="goals">Goals</label>
                <textarea class="form-control" name="goals" id="goals" rows="4" placeholder="Lesson goals">{{ $goals }}</textarea>
            </div>
        </div>
    </div>
</section>

<section class="lecture__info" id="materials">
    <div class="panel">
        <div class="panel-heading text-uppercase ls-1">
            Materials
        </div>
        <div class="panel-body">

            <!-- Materials -->
            <div class="input_fields_wrap">
                <div class="form-group">
                    <label for="readings">Readings</label>
                    @if ($readings)
                        @foreach ($readings as $reading)
                            <div class="flex align-center">
                                <input type="text" class="form-control" name="readings[]" value="{{ Request::is('*/*/create') ? $reading : $reading->title }}" placeholder="Readings"/><a href="#" class="remove_field" >Remove</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <button class="add_field_button">Add More Fields</button>
        </div>
    </div>
</section>

<section>
    <div class="form-group">
        <button type="submit" class="btn btn-default pull-right create__button" >
            {{ $button }}
        </button>
    </div>
    <div class="clearfix"></div>
</section>