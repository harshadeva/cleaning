<label for="budget_year">{{ __('common.Budget of Year') }}</label>
<select class="select2-single form-control" id="budget_year" name="budget_year">
    <option disabled selected>{{ __('common.Select year') }}</option>
    @foreach ($budgetYears as $budgetYear)
        @if (isset($search['year']) ? $budgetYear->year == $search['year'] : $budgetYear->year == date('Y'))
            <option selected value="{{ $budgetYear->id }}">{{ $budgetYear->year }}</option>
        @else
            <option value="{{ $budgetYear->id }}">{{ $budgetYear->year }}</option>
        @endif
    @endforeach
</select>
