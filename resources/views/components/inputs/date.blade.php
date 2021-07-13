  <div class="form-group">
      <label for="{{ $name ?? 'name' }}">{{ __('common.' . $label) ?? __('common.Date') }}</label>
      <div class="input-group">
          <input type="text" id="{{ $name }}" name="{{ $name }}" autocomplete="off"
             value="{{ $value ?? old($name) }}"   class="autoclose-date datepicker-here form-control" placeholder="YYYY / MM / DD"
              aria-describedby="basic-addon3" />
          <div class="input-group-append">
              <span class="input-group-text" id="basic-addon3"><i class="feather icon-calendar"></i></span>
          </div>
      </div>
      <span class="text-danger">{{ $errors->first($name) }}</span>
  </div>
