<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <div class="card-body">
                <h4  class="page-title-sm">@yield('title')</h4>
                @yield('breadcrump')
            </div>
        </div>
        @yield('action')
        {{-- <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                </div>
            </div> --}}
    </div>
</div>
