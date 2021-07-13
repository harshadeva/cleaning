<label for="student" class="control-label">{{ __('common.Student') }}</label>
<div>
    <div class="input-group">
        <select id="student" name="student" class="select2-single form-control">
            <option value="" selected disabled>{{ __('common.Select student') }}</option>
            @if (isset($students) && $students != null)
                @foreach ($students as $student)
                    <option value="{{ isset($personRequest) ? $student->person->id :  $student->id }}">{{ $student->admission_number }} :
                        {{ $student->display }}
                    </option>
                @endforeach
            @endif
        </select>

    </div>
</div>
