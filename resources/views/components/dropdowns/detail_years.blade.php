<label for="year">{{ __('common.Year') }}</label>
<select class="select2-single form-control" id="year" name="year">
    <option disabled selected>{{ __('common.Select year') }}</option>
    @foreach (range(Auth::user()->school->start_year, date('Y') + 13) as $year)
        @if (isset($record) ? $year == $record->year : $year == date('Y')+1)
            <option selected value="{{ $year }}">{{ $year }}</option>
        @else
            <option value="{{ $year }}">{{ $year }}</option>
        @endif
    @endforeach
</select>
