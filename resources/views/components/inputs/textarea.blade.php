<div class="form-group">
    <label for="{{ $name }}">{{ __('common.' . $label) }}</label>
    <textarea class="form-control" name="{{ $name }}" id="{{ $name }}"
        placeholder="{{ $placeholder }}"> {{ $value ?? old($name) }} </textarea>
    <span class="text-danger">{{ $errors->first($name) }}</span>

</div>
