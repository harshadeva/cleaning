@extends('layouts.main')
@section('title')
    Employee Details
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a
                    href="{{ route('user.index') }}">{{ __('common.Employee') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.Employee Details') }}</li>
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
        <div class="row">
            <div class="col-md-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{ $record->name }}</h4>
                                <hr />
                            </div>

                            <div class="col-md-6">
                                <p title="User role">
                                    <em class="fa fa-address-card"></em>
                                    {{ $record->employees()->first()->employeeType->name }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p title="Company name">
                                    <em class="fa fa-building"></em> {{ $record->employees()->first()->company->name }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p title="Email">
                                    <em class="fa fa-envelope-o"></em> {{ $record->email }}
                                </p>
                            </div>

                            @if ($record->employees()->first()->employee_type_id != 1)
                                <div class="col-md-12">
                                    <hr />
                                </div>
                                <div class="col-md-12">
                                    <h6>Total Works :
                                        {{ $record->employees()->first()->reportSections()->active()->count() }}</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6>Avarage Rating : {{ $record->employees()->first()->getAvarageRating() }}</h6>
                                </div>
                            @endif



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
