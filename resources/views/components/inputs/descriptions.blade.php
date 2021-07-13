 <label for="description">{{ __('common.Description') }}</label>
 <div class="form-group">
     <textarea class="form-control" name="description" id="description"
         placeholder="Description">{{ $value ?? old($name) }} </textarea>
     <span class="text-danger">{{ $errors->first($name) }}</span>
 </div>
