@extends('layouts.main')
@section('title')
    Company Create
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{ route('admin.company.index') }}">{{ __('common.Company') }}</a></li>
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
        <form action="{{ route('admin.company.store') }}" method="POST">
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
                                            ['label'=>'Company Name','name'=>'company_name','placeholder'=>'Enter company name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.date',['label'=>'Start Date','name'=>'start_date'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Contact Number - 1','name'=>'contact_no_1','placeholder'=>'Ener contact number'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Contact Number - 2','name'=>'contact_no_2','placeholder'=>'Ener contact number'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.textarea',['label'=>'Address','name'=>'address','placeholder'=>'Address'])
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
                             @include('components.forms.first_user_registration',['header'=>'Company Admin Details'])
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

    <!-- Select2 js -->
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <!-- Tagsinput js -->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom-form-select.js') }}"></script>
@endsection
