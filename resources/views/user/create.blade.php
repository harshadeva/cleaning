@extends('layouts.main')
@section('title')
    User Create
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a
                    href="{{ route('company.index') }}">{{ __('common.Company') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.Create') }}</li>
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
        <form action="{{ route('company.store') }}" method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="card m-b-30">
                        <div class="row">
                            <!-- Start col -->
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h4>User Details</h4>
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'First Name','name'=>'first_name','placeholder'=>'Enter first name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'First Name','name'=>'first_name','placeholder'=>'Enter first name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Last Name','name'=>'last_name','placeholder'=>'Enter last name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.email',['label'=>'Email','name'=>'email','placeholder'=>'Enter
                                            email'])
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
@endsection
