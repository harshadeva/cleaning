<label for="amount">{{ __('common.Amount') }}</label>
<input type="number" class="form-control" step="0.01"  value="{{ $value ?? old($name) }}" 
    {{ isset($minusAllowed) ? '' : "min = '0'" }} placeholder="0" name="amount" id="amount">
<span class="text-danger">{{ $errors->first($name) }}</span>
