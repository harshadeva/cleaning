 <label for="category">{{ __('common.Category') }}</label>
 <select class="select2-single form-control" id="category" name="category">
     <option value="" disabled selected>{{ __('common.Select category') }}</option>
     @foreach ($categories as $category)
         @if (isset($record) ? $record->category_id == $category->id : old('category') == $category->id)
             <option selected value="{{ $category->id }}">{{ $category->display }}</option>
         @else
             <option value="{{ $category->id }}">{{ $category->display }}</option>
         @endif
     @endforeach
 </select>
