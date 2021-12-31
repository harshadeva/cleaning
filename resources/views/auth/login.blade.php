<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Auditdeck">
    <meta name="author" content="Harshadeva priyankara bandara">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Auditdeck - Login</title>
    <!-- Fevicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"> --}}
    <!-- Start CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- End CSS -->
</head>

<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-head">
                                            <a href="{{ url('/') }}" class="logo"><img
                                                    src="{{ asset('assets/images/login_form.png') }}" class="img-fluid"
                                                    alt="logo"></a>
                                        </div>
                                        <h4 class="text-primary my-4">Log in !</h4>

                                        @if (count($errors) > 0)
                                            @foreach ($errors->all() as $message)
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    <span>{{ $message }}</span>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="Enter email here" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter password here" required>
                                        </div>
                                        <div class="form-row mb-3">
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-checkbox text-left">
                                                    <input type="checkbox" class="custom-control-input" id="rememberme">
                                                    <label class="custom-control-label font-14"
                                                        for="rememberme">Remember me</label>
                                                </div>
                                            </div>
                                            {{-- <div class="col-sm-6">
                                                <div class="forgot-psw">
                                                    <a id="forgot-psw" href="{{ url('/user-forgotpsw') }}"
                                                        class="font-14">Forgot password?</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <button type="submit" class="btn btn-success btn-lg btn-block font-18">Log
                                            in</button>
                                    </form>
                                    {{-- <div class="login-or">
                                        <h6 class="text-muted">OR</h6>
                                    </div> --}}
                                    {{-- <div class="social-login text-center">
                                        <button type="submit" class="btn btn-primary-rgba font-18"><i class="mdi mdi-facebook mr-2"></i>Facebook</button>
                                        <button type="submit" class="btn btn-danger-rgba font-18"><i class="mdi mdi-google mr-2"></i>Google</button>
                                    </div> --}}
                                    {{-- <p class="mb-0 mt-3">Don't have a account? <a href="{{route('register')}}">Sign up</a></p> --}}
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <!-- End js -->
</body>

</html>
