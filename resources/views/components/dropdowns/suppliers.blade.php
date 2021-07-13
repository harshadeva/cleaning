<label for="supplier">{{ __('common.Supplier') }}</label>
<select class="select2-single form-control" id="supplier" name="supplier">
    <option value="" disabled selected>{{ __('common.Select supplier') }}</option>
    @foreach ($suppliers as $supplier)
        <option value="{{ $supplier->person->id }}">{{ $supplier->display }}</option>
    @endforeach
</select>
