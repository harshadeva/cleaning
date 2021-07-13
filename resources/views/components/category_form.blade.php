<div class="card m-b-30">
    <div class="card-body">
        <div class="row">
            @csrf
            <div class="col-lg-12 form-group">
               @include('components.dropdowns.categories')
            </div>

            <div class="col-lg-4 form-group">
                @include('components.dropdowns.payment_methods')
            </div>

            <div class="col-lg-4">
                @include('components.inputs.amount')
            </div>

            <div class="col-lg-4">
                @include('components.inputs.voucher')
            </div>

            <div class="col-lg-4">
                <label for="effected">{{ __('common.Effected Date') }}</label>
                <div class="input-group">
                    <input type="text" id="effected" name="effected" autocomplete="off"
                        class="autoclose-date datepicker-here form-control" placeholder="yyyy/mm/dd"
                        aria-describedby="basic-addon3" />
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon3"><i class="feather icon-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-2">
                @include('components.inputs.descriptions')
            </div>

        </div>
    </div>
</div>

@include('components.payment_methods')

<div class="card m-b-30">
    <div class="card-body">
        <h5 class="card-title">{{ $prefix }} {{ __('common.Person') }}</h5>
        <div class="row">

            <div class="col-lg-4">
                <label for="person_type">{{ __('common.Person Type') }}</label>
                <select class="select2-single form-control" id="person_type" name="person_type">
                    <option value=""  selected>{{ __('common.Select type') }}</option>
                    <option value="1">{{ __('common.Student') }}</option>
                    <option value="2">{{ __('common.Supplier') }}</option>
                    <option value="3">{{ __('common.Teacher') }}</option>
                </select>
            </div>

            <div id="studentDiv" style="display: none" class="col-lg-8 form-group">
                @include('components.dropdowns.students',['personRequest'=>1])
            </div>
            <div id="supplierDiv" style="display: none" class="col-lg-8 form-group">
                @include('components.dropdowns.suppliers')
            </div>
             <div id="teacherDiv" style="display: none" class="col-lg-8 form-group">
                @include('components.dropdowns.teachers')
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-3 form-group">
                @include('components.buttons.submit')
            </div>
        </div>
    </div>
</div>
