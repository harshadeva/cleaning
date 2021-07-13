<label for="payment_method">{{ __('common.Payment Method') }}</label>
<select class="select2-single form-control" id="payment_method" name="payment_method">
    <option value="" {{!isset($doNotDisable) ? 'disabled':''}} selected>{{ __('common.Select method') }}</option>
    @foreach ($paymentMethods as $paymentMethod)
        <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->type }}</option>
    @endforeach
</select>
