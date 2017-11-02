<option value="">Select a year</option>
@foreach ($years as $year)
    <option value="{{ $year }}"
        @if ($lesson)
            {{ $year == $lesson->year ? 'selected' : ''  }}
        @endif
    >
        {{ $year }}
    </option>
@endforeach