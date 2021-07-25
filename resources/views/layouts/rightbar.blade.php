<div class="rightbar">

    <!-- Start Topbar Web /  Mobile -->
    @include('layouts.topbar-mobile')
    @include('layouts.topbar-web')
    

    <!-- Start Breadcrumbbar -->
    @include('layouts.breadcrumb')

    <!-- Page Content -->
    @yield('rightbar-content')

    <!-- Start Footerbar -->
    @include('layouts.footer')
</div>
