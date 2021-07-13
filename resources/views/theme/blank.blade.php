@section('title')
Switchery
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')
<!-- Start Contentbar -->
<div class="contentbar">

                         <input type="checkbox" class="js-switch-primary" checked />
                         <input type="checkbox" class="js-switch-primary" checked />
                         <input type="checkbox" class="js-switch-primary" checked />
                        <input type="checkbox" class="js-switch-secondary" checked />
                        <input type="checkbox" class="js-switch-success" checked />
                        <input type="checkbox" class="js-switch-danger" checked />

    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-6">
            <div class="card m-b-30">
                <div class="card-body">

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
<!-- Custom Switchery js -->
<script src="{{ asset('assets/js/custom/custom-switchery.js') }}"></script>
<script>
</script>
@endsection
