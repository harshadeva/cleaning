<div class="form-group">
    <label for="{{ $name }}">{{ __('common.' . $label) }}</label>
    <input type="password" class="form-control" placeholder="{{ $placeholder ?? '' }}" name="{{ $name }}"
        id="{{ $name }}">
    <span class="text-danger">{{ $errors->first($name) }}</span>

</div>
