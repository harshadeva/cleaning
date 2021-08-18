@extends('layouts.main')
@section('title')
    Site View
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page"><a
                    href="{{ route('site.index') }}">{{ __('common.Site') }}</a></li>
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
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div class="row">
            <div class="col-md-6">
                <div class="card m-b-30">
                    <div class="row">
                        <div class="card-body">
                            <div class="col-md-12">
                                <h4>{{ $record->name }}</h4>
                                <hr />
                            </div>
                            <div class="col-md-12">
                                <p> <em class="fa fa-map-marker"></em>
                                    {{ $record->address }}
                                </p>
                            </div>
                            @if ($record->contact_no1 != null || $record->contact_no2 != null)
                                <div class="col-md-12">
                                    <p><em class="fa fa-phone"></em>
                                        {{ $record->contact_no1 }} / {{ $record->contact_no2 }}
                                    </p>
                                </div>
                            @endif
                             <div class="col-md-12">
                                 <hr/>
                             </div>
                              <div class="col-md-12">
                                 <h6>Site Admin : {{ $record->admin->name }} </h6>
                                 <h6>Reports Count : {{ $record->reports()->active()->count() }} </h6>
                                 <h6>Avarage Rating : {{ $record->getAvarageRating() }} </h6>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
