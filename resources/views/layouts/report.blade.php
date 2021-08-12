<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <title> @yield('title') </title>

    <!-- styles -->
    @include('layouts.styles')
</head>

<body class="vertical-layout">

    <!-- Start Containerbar -->
    <div id="containerbar">
        @yield('content')
    </div>

    <!-- scripts -->
    @include('layouts.scripts')
</body>

</html>
