@extends('layouts.main')
@section('title')
    Edit Employee
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('common.Employee') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.Edit') }}</li>
        </ol>
    </div>
@endsection
@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <form action="{{ route('user.update', ['user' => $record->id]) }}" method="POST">
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card m-b-30">
                        <div class="row">
                            <!-- Start col -->
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h4>Employee Details</h4>
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-12 form-group">
                                            @if ($record->employees()->first()->employee_type_id == 1)
                                            <input type="hidden" value="1" name="employee_type_id" />
                                                @include('components.inputs.text',
                                                ['label'=>'Designation','id'=>'employee_type','name'=>'employee_type','disabled'=>'disabled',
                                                'value'=>"Company Admin"])
                                            @else
                                                <label for="user_role">{{ __('common.Designation') }}</label>
                                                <select class="select2-single form-control" id="employee_type_id"
                                                    name="employee_type_id">
                                                    <option disabled selected>{{ __('common.Select employee type') }}</option>
                                                    @foreach ($employeeTypes as $employeeType)
                                                        <option value="{{ $employeeType->id }}">{{ $employeeType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif

                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'First Name','name'=>'first_name','placeholder'=>'Enter first name',
                                            'value'=>$record->first_name])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Last Name','name'=>'last_name','placeholder'=>'Enter last name',
                                            'value'=>$record->last_name])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.email',['label'=>'Email','name'=>'email','placeholder'=>'Enter
                                            email', 'value'=>$record->email])
                                        </div>

                                        <div class="col-lg-12">
                                            @include('components.inputs.password',['label'=>'Password','name'=>'password'])
                                        </div>

                                        <div class="col-lg-12">
                                            @include('components.inputs.password',
                                            ['label'=>'Re-Enter Password','name'=>'password_confirmation'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row mb-5 mt-n3">
                <div class="col-md-12">
                    @include('components.buttons.submit')
                </div>
            </div>
        </form>
    </div>
    <!-- End Contentbar -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            let userRole = "{{ $record->employees()->first()->employee_type_id }}";
            if (userRole != 1) {
                $('#employee_type_id').val(userRole).trigger('change');
            }
        });
    </script>
@endsection
