@section('title')
    {{ __('common.Update User') }}
@endsection
@section('breadcrump')
    <div class="breadcrumb-list">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('common.Home') }}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{ __('common.User') }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('common.Update User') }}</li>
        </ol>
    </div>
@endsection
@section('action')
 <div class="col-md-4 col-lg-4">
        @include('components.buttons.back',['url'=>route('user.index', app()->getLocale())])
</div>
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form action="{{ route('user.update',['language'=>app()->getLocale(),'user'=>$user->id]) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">

                                <div class="col-lg-4">
                                    <label for="username">{{ __('common.Username') }}</label>
                                    <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}" placeholder="Name">
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <label for="password">{{ __('common.Password') }}</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"
                                            value="" id="password" placeholder="min lenght : 8">
                                    </div>
                                </div>
                                 <div class="col-lg-4">
                                    <label for="password_confirmation">{{ __('common.Password Confirmation') }}</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            value="" id="password_confirmation" placeholder="min lenght : 8">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-success"> {{__('common.Update')}} </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@section('script')

@endsection
