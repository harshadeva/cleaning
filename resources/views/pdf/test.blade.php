@extends('layouts.main')

@section('title')
    Reports
@endsection

@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
        </ol>
    </div>
@endsection

@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-12">

                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="display table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('common.Date') }}</th>
                                        <th>{{ __('common.Site') }}</th>
                                        <th>{{ __('common.Rating') }}</th>
                                        <th>{{ __('common.Created By') }}</th>
                                        <th>{{ __('common.Created At') }}</th>
                                        <th class="text-center">{{ __('common.Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

<img src="{{ $image }}"/>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection

