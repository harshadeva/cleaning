<label for="voucher">{{ __('common.Voucher') }}</label>
<input type="text" class="form-control" value="{{ $value ?? old($name) }}" placeholder="Voucher Number" name="voucher"
    id="voucher">
<span class="text-danger">{{ $errors->first($name) }}</span>
