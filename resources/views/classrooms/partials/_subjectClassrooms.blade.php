<option value="" selected="" disabled="">Select a classroom</option>
@foreach ($user->teacher->subjects as $subj)
    @if ($subj->id == $subject->id)
        <option value="{{ $subj->pivot->classroom }}">
            {{ \App\Classroom::where('label', $subj->pivot->classroom)->first()->label }}
        </option>
    @endif
@endforeach
