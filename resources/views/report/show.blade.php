@extends('layouts.main')
@section('title')
    Report View
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a
                    href="{{ route('report.index') }}">{{ __('common.Report') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.View') }}</li>
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
    <div class="contentbar">
       <div id="app">
            <report-view record="{{ $record }}"></report-view>
        </div>
    </div>
@endsection
