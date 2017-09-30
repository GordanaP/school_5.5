<p class="required__fields">Fields marked with * are required.</p>

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
                            {{ ucwords($subject->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Year -->
        <div class="col-md-4">
            <div class="form-group">
                <label for="year">Academic year <span class="asterisk">*</span></label>
                <select class="form-control" name="year" id="year">
                    <option selected="" disabled="">Select a year</option>
                    @foreach (Year::all() as $label => $name)
                        <option value="{{ $label }}"
                            {{ selected($label, $year) }}
                        >
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

<div class="flex align-center">
    <div class="trapezoid"></div>
    <span class="text-uppercase ls-1 text__trapezoid">General</span>
</div>
<section class="lecture__info" id="general">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-3">
                <p><small>Enter the lesson title, topic, and goals.</small></p>
            </div>

            <div class="col-md-9">
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $title }}" placeholder="Lesson title">
                </div>

                <!-- Topic -->
                <div class="form-group">
                    <label for="topic">Topic <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="topic" id="topic" value="{{ $topic }}" placeholder="Lesson topic">
                </div>

                <!-- Goals -->
                <div class="form-group">
                    <label for="goals">Goals <span class="asterisk">*</span></label>
                    <textarea class="form-control" name="goals" id="goals" rows="4" placeholder="Lesson goals">{{ $goals }}</textarea>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Readings -->
<div class="flex align-center">
    <div class="trapezoid"></div>
    <span class="text-uppercase ls-1 text__trapezoid">Readings</span>
</div>
<section class="lecture__info" id="materials">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-3">
                <p><small>Enter at least one of up to three readings recommended for the lesson.</small></p>
            </div>

            <div class="col-md-9">

                @if ($readings)

                    <label>Readings  <span class="asterisk">*</span></label>

                    <!-- The readings fields with old input values -->
                    @foreach ($readings as $key => $reading)
                        @if ($reading != null)
                        <div class="form-group">
                            <div class="flex">
                                <input type="text" class="form-control" name="readings[]" placeholder=" Add readings" value="{{ Request::segment(3) == 'create' ? $reading : $reading->title }}" />
                                @if ($key == 0 )
                                    <button type="button" class="btn btn-default addReadingsButton" {{ count($readings_array) == 4 || count($readings) == 3 ? 'disabled' : '' }}><i class="fa fa-plus"></i></button>
                                @else
                                    <button type="button" class="btn btn-default removeReadingsButton"><i class="fa fa-minus"></i></button>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <!-- The initial readings input field -->
                    <div class="form-group">
                        <label>Readings  <span class="asterisk">*</span></label>
                        <div class="flex">
                            <input type="text" class="form-control" name="readings[]" placeholder=" Add readings" value="" />
                            <button type="button" class="btn btn-default addReadingsButton"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                @endif

                <!-- The readings field template containing a readings field and a remove button -->
                <div class="form-group hide" id="readingsTemplate">
                    <div class="flex">
                        <input class="form-control" type="text" name="readings[]" placeholder="Add readings" />
                        <button type="button" class="btn btn-default removeReadingsButton"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Button -->
<section>
    <div class="form-group">
        <button type="submit" class="btn btn-default btn-lg pull-right create__button" data-user="{{ $user->name }}">
            {{ $button }}
        </button>
    </div>
    <div class="clearfix"></div>
</section>