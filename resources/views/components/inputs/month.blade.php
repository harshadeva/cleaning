  <label for="{{ $name ?? 'date' }}">{{ $label ?? __('common.Date') }}</label>
  <div class="input-group">
      <input type="text" id="{{ $name ?? 'date' }}" name="{{ $name ?? 'date' }}" autocomplete="off"
          class="form-control month-picker" />
      <div class="input-group-append">
          <span class="input-group-text" id="month-icon"><i class="feather icon-calendar"></i></span>
      </div>
      <span class="text-danger">{{ $errors->first($name) }}</span>

  </div>
