<!-- Title -->
<div class="form-group">
    <label for="title">Title</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="icon_star_alt"></i></span>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter event title">
    </div>
</div>

<!-- Description -->
<div class="form-group">
    <label for="description">Description</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
        <input type="text" class="form-control" name="description" id="description" placeholder="Enter event description">
    </div>
</div>

<!-- Subject -->
<div class="form-group">
    <label for="subject">Subject</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="icon_pushpin_alt"></i></span>
        <select class="form-control" name="subject_id" id="subject_id">
            <option value="" selected="" disabled="">Select a subject</option>
                @foreach ($user->subjects_unique as $subject)
                    <option value="{{ $subject->id }}">
                        {{ ucwords($subject->name) }}
                    </option>
                @endforeach
        </select>
    </div>
</div>

<!-- Classroom -->
<div class="form-group">
    <label for="classroom">Classroom</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
        <select class="form-control" name="classroom_id" id="classroom_id">
            <option value="" selected="" disabled="">Select a classroom</option>
            {{-- @foreach ($user->teacher->subjects as $subj)
                <option value="{{ $subj->pivot->classroom_id }}">
                    {{ \App\Classroom::where('id', $subj->pivot->classroom_id)->first()->label }}
                </option>
            @endforeach --}}
            <!-- Options for the selected subject only by using an ajax call -->
        </select>
    </div>
</div>

<!-- Date -->
<div class="form-group">
    <label for="date">Date</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="text" class="form-control" name="date" id="date" placeholder="YYYY-MM-DD">
    </div>
</div>

<div class="row">

    <!-- Start-->
    <div class="col-md-6">
        <div class="form-group">
            <label for="start">Start</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="text" class="form-control" name="start" id="start" placeholder="hh:mm">
            </div>
        </div>
    </div>

    <!-- End -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="end">End</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="text" class="form-control" name="end" id="end" placeholder="hh:mm">
            </div>
        </div>
    </div>
</div>

