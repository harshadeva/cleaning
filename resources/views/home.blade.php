@extends('layouts.main')
@section('title')
    Dashboard
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.Dashboard') }}</li>
        </ol>
    </div>
@endsection

@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <div id="app">

            <div class="row">

                @if(isset($sectionsCount))
                <div class="col-md-4">
                   @include('components.dashboard.card',['icon'=>'fa fa-building','name'=>'Sections','class'=>'text-primary','value'=>$sectionsCount])
                </div>
                @endif

                 @if(isset($subscriptionsCount))
                <div class="col-md-4">
                   @include('components.dashboard.card',['icon'=>'fa fa-diamond','name'=>'Subscriptions','class'=>'text-primary','value'=>$subscriptionsCount])
                </div>
                @endif

                @if(isset($sitesCount))
                <div class="col-md-4">
                   @include('components.dashboard.card',['icon'=>'fa fa-building','name'=>'Sites','class'=>'text-primary','value'=>$sitesCount])
                </div>
                @endif

                @if(isset($employeesCount))
                 <div class="col-md-4">
                    @include('components.dashboard.card',['icon'=>'fa fa-users','name'=>'Employees','class'=>'text-success','value'=>$employeesCount])
                </div>
                @endif

                @if(isset($reportsCount))
                <div class="col-md-4">
                    @include('components.dashboard.card',['icon'=>'fa fa-file-pdf-o','name'=>'Reports','class'=>'text-info','value'=>$reportsCount])
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection
