<div class="col-lg-9 form-group">
    <label for="category">{{ __('common.Category') }}</label>
    <select class="select2-single form-control" id="category" name="category">
        <option value="" selected>{{ __('common.All') }}</option>
        @if (isset($categories))
            @foreach ($categories as $category)
                @if (isset($search->category) && $search->category == $category->id)
                    <option selected value="{{ $category->id }}">{{ $category->display }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->display }}</option>
                @endif
            @endforeach
        @endif
    </select>
</div>


<div class="col-lg-3 form-group">
    <label for="method">{{ __('common.Method') }}</label>
    <select class="select2-single form-control" id="method" name="method">
        <option value="" selected>{{ __('common.All') }}</option>
        @if (isset($methods))
            @foreach ($methods as $method)
                @if (isset($search->method) && $search->method == $method->id)
                    <option selected value="{{ $method->id }}">{{ $method->type }}</option>
                @else
                    <option value="{{ $method->id }}">{{ $method->type }}</option>
                @endif
            @endforeach
        @endif
    </select>
</div>


<div class="col-lg-4">
    <label for="from">{{ __('common.From (Date)') }}</label>
    <div class="input-group">
        <input type="text" id="from" name="from" autocomplete="off" class="autoclose-date datepicker-here form-control"
            placeholder="yyyy/mm/dd" aria-describedby="basic-addon3" />
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon3"><i class="feather icon-calendar"></i></span>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <label for="to">{{ __('common.To (Date)') }}</label>
    <div class="input-group">
        <input type="text" id="to" name="to" autocomplete="off" class="autoclose-date datepicker-here form-control"
            placeholder="yyyy/mm/dd" aria-describedby="basic-addon3" />
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon3"><i class="feather icon-calendar"></i></span>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <label for="person_type">{{ __('common.Status') }}</label>
    <select class="select2-single form-control" id="status" name="status">
        <option value="" selected>{{ __('common.All') }}</option>
        <option value="1"> {{ __('common.Pending') }}</option>
        <option value="2"> Approved</option>
        <option value="3"> Rejected</option>
    </select>
</div>

<div class="col-lg-4">
    <label for="person_type">Person Type</label>
    <select class="select2-single form-control" id="person_type" name="person_type">
        <option value="" selected>{{ __('common.All') }}</option>
        <option value="1">{{ __('common.Student') }}</option>
        <option value="2">{{ __('common.Supplier') }}</option>
        <option value="3">{{ __('common.Teacher') }}</option>
    </select>
</div>

<div id="studentDiv" style="display: none" class="col-lg-6 form-group">
    <label for="student">{{ __('common.Student') }}</label>
    <select class="select2-single form-control" id="student" name="student">
        <option value="" selected>{{ __('common.All') }}</option>
        @foreach ($students as $student)
            <option value="{{ $student->person->id }}">{{ $student->display }}</option>
        @endforeach
    </select>
</div>
<div id="supplierDiv" style="display: none" class="col-lg-6  form-group">
    <label for="supplier">{{ __('common.Supplier') }}</label>
    <select class="select2-single form-control" id="supplier" name="supplier">
        <option value="" selected>{{ __('common.All') }}</option>
        @foreach ($suppliers as $supplier)
            <option value="{{ $supplier->person->id }}">{{ $supplier->display }}</option>
        @endforeach
    </select>
</div>
<div id="teacherDiv" style="display: none" class="col-lg-6  form-group">
    <label for="teacher">{{ __('common.Teacher') }}</label>
    <select class="select2-single form-control" id="teacher" name="teacher">
        <option value="" selected>{{ __('common.All') }}</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->person->id }}">{{ $teacher->display }}</option>
        @endforeach
    </select>
</div>


<div class="col-md-2">
    @include('components.buttons.search',['classes'=>'btn-block btnTopMargin'])
</div>
