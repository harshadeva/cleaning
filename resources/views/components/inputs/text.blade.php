<div class="form-group">
    <label for="{{ $name }}">{{ __('common.' . $label) }}</label>
    <input type="text" value="{{ $value ?? old($name) }}"  class="form-control" {{ isset($disabled) ? 'disabled':'' }} placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}"
        id="{{ $name }}">
    <span class="text-danger">{{ $errors->first($name) }}</span>

</div>
