<div class="col-lg-12 form-group">
    <label for="city">{{ $name }}</label>
    <select class="select2-single form-control" id="{{ $name }}" name="{{ $name }}">
        <option disabled selected>{{ __('common.Select City') }}</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }} : {{ $city->divisional->name }} -
                {{ $city->divisional->zone->name }}</option>
        @endforeach
    </select>
</div>
</div>
