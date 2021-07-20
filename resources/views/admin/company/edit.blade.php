@extends('layouts.main')
@section('title')
    Company Edit
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a
                    href="{{ route('admin.company.index') }}">{{ __('common.Company') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.Edit') }}</li>
        </ol>
    </div>
@endsection
@section('style')
    <!-- Select2 css -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Tagsinput css -->
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css') }}" rel="stylesheet"
        type="text/css" />

@endsection
@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <form action="{{ route('admin.company.update', ['company' => $record->id]) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="admin_user_id" value="{{ $record->admin()->user_id }}">

            <div class="row">
                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="row">
                            <!-- Start col -->
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h4>Company Details</h4>
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            [
                                            'label'=>'Company Name',
                                            'name'=>'company_name','value'=>$record->name,'placeholder'=>'Enter
                                            company name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.date',[
                                            'label'=>'Start Date',
                                            'name'=>'start_date'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            [
                                            'label'=>'Contact No 1',
                                            'name'=>'contact_no_1','value'=>$record->contact_no1,'placeholder'=>'0xxxxxxxxx'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            [
                                            'label'=>'Contact No 2',
                                            'name'=>'contact_no_2','value'=>$record->contact_no2,'placeholder'=>'0xxxxxxxxx'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.textarea',['label'=>'Address','value'=>$record->address,'name'=>'address','placeholder'=>'Address'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="row">
                            <!-- Start col -->
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h4>Company Admin Details</h4>
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            [
                                            'label'=>'First Name',
                                            'name'=>'first_name','value'=>$record->admin()->user->first_name,'placeholder'=>'Enter
                                            first name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            [
                                            'label'=>'Last Name',
                                            'name'=>'last_name','value'=>$record->admin()->user->last_name,'placeholder'=>'Enter
                                            last name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.email',['label'=>'Email','value'=>$record->admin()->user->email,'name'=>'email'])
                                        </div>

                                        <div class="col-lg-12">
                                            @include('components.inputs.password',['label'=>'Password','name'=>'password'])
                                        </div>

                                        <div class="col-lg-12">
                                            @include('components.inputs.password',
                                            ['label'=>'Re-Enter Password','name'=>'password_confirmation'])
                                        </div>

                                        <div class="col-lg-12">
                                            @include('components.buttons.submit',['classes'=>'btnTopMargin'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Contentbar -->
@endsection
@section('script')

    <!-- Select2 js -->
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <!-- Tagsinput js -->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-form-select.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#start_date').val("{{ date('Y/m/d', strtotime($record->start_date)) }}");
        });
    </script>
@endsection
