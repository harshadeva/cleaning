@extends('layouts.main')
@section('title')
    Site Create
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a
                    href="{{ route('site.index') }}">{{ __('common.Site') }}</a></li>
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
        <form action="{{ route('site.store') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="row">
                            <!-- Start col -->
                            <div class="card-body">
                                <div class="col-md-12">
                                    <h4>Site Details</h4>
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        @csrf
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Site Name','name'=>'site_name','placeholder'=>'Enter site name'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Contact Number - 1','name'=>'contact_no_1','placeholder'=>'Enter contact number'])
                                        </div>
                                        <div class="col-lg-12">
                                            @include('components.inputs.text',
                                            ['label'=>'Contact Number - 2','name'=>'contact_no_2','placeholder'=>'Enter contact number'])
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
                            @include('components.forms.first_user_registration',['header'=>'Site Admin Details'])

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        @include('components.forms.section_adding_form',['header'=>'Sections Details'])
                        <span class="text-danger">{{ $errors->first('sections') }}</span>
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
    <script src="{{ asset('assets/js/custom/custom-repeater.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#repeater").createRepeater();
            if ($('.items').length == 0) {
                $('#reapeater-add-btn').click();
            }
        });
    </script>

@endsection
