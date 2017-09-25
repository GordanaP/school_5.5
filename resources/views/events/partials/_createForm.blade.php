<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Enter event title">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" name="description" id="description" placeholder="Enter event description">
</div>

<div class="form-group">
    <label for="subject">Subject</label>
    <select class="form-control" name="subject" id="subject">
        <option selected="" disabled="">Select a subject</option>
        <option value="Maths">Maths</option>
        <option value="history">History</option>
    </select>
</div>

<div class="form-group">
    <label for="classroom">Classroom</label>
    <select class="form-control" name="classroom" id="classroom">
        <option selected="" disabled="">Select a classroom</option>
        <option value="I-1">I-1</option>
        <option value="I-2">I-2</option>
    </select>
</div>

<div class="form-group">
    <label for="date">Date</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="text" class="form-control" name="date" id="date" placeholder="YYYY-MM-DD">
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="start">Start</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="text" class="form-control" name="start" id="start" placeholder="hh:mm">
            </div>
        </div>
    </div>
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

