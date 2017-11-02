<option value="">Select a classroom</option>
@foreach ($subjects as $subj)
    <option value="{{ $subj->pivot->classroom_id }}"
        @if ($event)
            {{ $subj->pivot->classroom_id == $event->classroom_id ? 'selected' : ''  }}
        @endif
    >
        {{ \App\Classroom::getLabel($subj->pivot->classroom_id) }}
    </option>
@endforeach

