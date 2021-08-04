<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    @include('layouts.meta')

    <title> @yield('title') </title>

    <!-- styles -->
    @include('layouts.styles')
    <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
    @routes
</head>

<body class="vertical-layout">

    <!-- Start Containerbar -->
    <div id="containerbar">

        <!-- Start Leftbar -->
        @include('layouts.leftbar.leftbar')

        <!-- Start Rightbar -->
        @include('layouts.rightbar')

        <div class="toast-alert">
            @include('layouts.toast-success')
            @include('layouts.toast-error')
        </div>
        @yield('content')

    </div>

    <!-- scripts -->
    @include('layouts.scripts')
</body>

</html>
