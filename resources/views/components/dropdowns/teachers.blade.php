<label for="teacher">{{ __('common.Teachers') }}</label>
<select class="select2-single form-control" id="teacher" name="teacher">
    <option value="" disabled selected>{{ __('common.Select teacher') }}</option>
    @foreach ($teachers as $teacher)
        <option value="{{ $teacher->person->id }}">{{ $teacher->display }}</option>
    @endforeach
</select>
